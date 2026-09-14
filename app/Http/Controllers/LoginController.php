<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $response = $this->requestUdsu($request->login, $request->password);
        $employeeXml = $this->parseXml($response);

        if(
            $this->employeeNotWork($employeeXml) 
                && 
            app()->isProduction()
        ){
            return back()->withErrors([
                'login' => 'Неверные учетные данные'
            ]);
        }

        $employee = $this->findOrCreateEmployee($employeeXml);
        
        if(! $employee->isVerified()){
            return back()->withErrors([
                'login' => 'Ожидайте подтверждения доступа админом'
            ]);
        }

        Auth::login($employee);
        $request->session()->regenerate();
        return redirect()->route('reports.index');
        
    }

    protected function requestUdsu(string $login, string $password)
    {
        return Http::get("https://io.udsu.ru/uio/portal_iias.auth?", [
            'p_who'      => 'viv',
            'p_login'  => $login,
            'p_password' => $password,
        ]);
    }

    protected function parseXml($response)
    {
        $xml = mb_convert_encoding($response->body(), 'UTF-8', 'Windows-1251');
        $xml = simplexml_load_string($xml);
        return $xml;
    }

    protected function employeeNotWork($employee):bool
    {
        $rolesString = (string) $employee->roles;
        return strpos($rolesString, ',СОТРУДНИК,') === false;
    }

    protected function findOrCreateEmployee($employee): User
    {
        if(!\intval($employee->pers_id)){
            Log::critical('employee_pers_id_not_int', [
                'employee' => $employee
            ]);
            abort(500);
        }

        $user = User::where('udsu_id', $employee->pers_id)->first();

        if($user){
            return $user;
        }
        
        $user = User::create([
            "surname" => $employee->f,
            'name' => $employee->i,
            'patronymic' => $employee->o ?? null,
            'udsu_id' => (int)$employee->pers_id,
            'is_verified' => false
        ]);

        return $user;
    }

    protected function employeeNotVerified($employee):bool
    {
        $rolesString = (string) $employee->roles;
        return strpos($rolesString, ',СОТРУДНИК,') === false;
    }

}
