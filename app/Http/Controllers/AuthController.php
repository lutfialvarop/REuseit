<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function viewLogin()
    {
        // dd(session('token'));
        return view('auth.login');
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'API_KEY' => env('API_KEY')
        ];

        try {
            $response = $client->request('POST', env('BASE_URL_API') . 'auth/login', [
                'headers' => $headers,
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password
                ]
            ]);

            $data = json_decode($response->getBody()->getContents());

            $request->session()->put('token', $data->data->token);

            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $data->data->token,
                'API_KEY' => env('API_KEY')
            ];

            $response = $client->request('GET', env('BASE_URL_API') . 'auth/user', [
                'headers' => $headers,
            ]);

            $data = json_decode($response->getBody()->getContents());

            $request->session()->put('role', $data->data->user->role);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('auth.login.view')->with('error', 'Email atau password salah');
        }

        return redirect()->route('content.index');
    }

    public function register(Request $request)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'API_KEY' => env('API_KEY')
        ];

        try {
            $client->request('POST', env('BASE_URL_API') . 'auth/register', [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password
                ]
            ]);
        } catch (\Exception $e) {
            return redirect()->route('auth.register.view')->with('error', 'Gagal mendaftar');
        }

        return redirect()->route('auth.login.view');
    }

    public function logout(Request $request)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->session()->get('token'),
            'API_KEY' => env('API_KEY')
        ];

        try {
            $client->request('POST', env('BASE_URL_API') . 'auth/logout', [
                'headers' => $headers,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('content.index')->with('error', 'Gagal logout');
        }

        $request->session()->forget('token');
        $request->session()->forget('role');

        return redirect()->route('auth.login.view');
    }
}
