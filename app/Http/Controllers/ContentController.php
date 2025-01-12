<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class ContentController extends Controller
{
    public function index()
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
            'API_KEY' => env('API_KEY')
        ];

        $response = $client->request('GET', env('BASE_URL_API') . 'content/get-all-content', [
            'headers' => $headers
        ]);

        $contents = json_decode($response->getBody()->getContents());

        $contents = $contents->data;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Number of items per page
        $contentsCollection = collect($contents);
        $total = $contentsCollection->count(); // Get the total count before slicing
        $currentItems = $contentsCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $contents = new LengthAwarePaginator($currentItems, $total, $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);


        return view('admin.content.index', compact('contents'));
    }

    public function detailContent($id)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'API_KEY' => env('API_KEY'),
            'Authorization' => 'Bearer ' . session('token'),
        ];

        try {
            $response = $client->request('GET', env('BASE_URL_API') . 'content/admin/' . $id, [
                'headers' => $headers
            ]);
        } catch (\Exception $e) {
            return redirect()->route('content.index')->with('error', 'Data tidak ditemukan');
        }

        $content = json_decode($response->getBody()->getContents());
        $content = $content->data[0];

        return view('admin.content.detail', compact('content'));
    }

    public function edit($id)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'API_KEY' => env('API_KEY'),
            'Authorization' => 'Bearer ' . session('token'),
        ];

        try {
            $response = $client->request('GET', env('BASE_URL_API') . 'content/admin/' . $id, [
                'headers' => $headers
            ]);
        } catch (\Exception $e) {
            return redirect()->route('content.index')->with('error', 'Data tidak ditemukan');
        }

        $content = json_decode($response->getBody()->getContents());
        $content = $content->data[0];

        return view('admin.content.update', compact('content'));
    }

    public function update($id, Request $request)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
            'API_KEY' => env('API_KEY'),
            'Idempotency-Key' => Str::random(32)
        ];

        $multipart = [
            [
                'name' => 'title',
                'contents' => $request->title,
            ],
            [
                'name' => 'header',
                'contents' => $request->header,
            ],
            [
                'name' => 'link_video',
                'contents' => $request->link_video,
            ],
            [
                'name' => 'content',
                'contents' => $request->content,
            ],
            [
                'name' => 'type_content',
                'contents' => $request->type_content,
            ],
            [
                'name' => 'type_trash',
                'contents' => $request->type_trash,
            ],
            [
                'name' => '_method',
                'contents' => 'PUT',
            ],
        ];

        if ($request->hasFile('image_tumbnail')) {
            $multipart[] = [
                'name' => 'image_tumbnail',
                'contents' => fopen($request->file('image_tumbnail')->getPathname(), 'r'),
                'filename' => $request->file('image_tumbnail')->getClientOriginalName(),
            ];
        }

        if ($request->hasFile('image_content')) {
            $multipart[] = [
                'name' => 'image_content',
                'contents' => fopen($request->file('image_content')->getPathname(), 'r'),
                'filename' => $request->file('image_content')->getClientOriginalName(),
            ];
        }

        try {
            $response = $client->request('POST', env('BASE_URL_API') . 'content/update/' . $id, [
                'headers' => $headers,
                'multipart' => $multipart,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('content.index')->with('error', 'Data tidak ditemukan');
        }

        if ($response->getStatusCode() == 200) {
            return redirect()->route('content.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('content.index')->with('error', 'Data gagal diubah');
        }
    }

    public function create()
    {
        return view('admin.content.create');
    }

    public function store(Request $request)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
            'API_KEY' => env('API_KEY'),
            'Idempotency-Key' => Str::random(32)
        ];

        $multipart = [
            [
                'name' => 'title',
                'contents' => $request->title,
            ],
            [
                'name' => 'header',
                'contents' => $request->header,
            ],
            [
                'name' => 'link_video',
                'contents' => $request->link_video,
            ],
            [
                'name' => 'content',
                'contents' => $request->content,
            ],
            [
                'name' => 'type_content',
                'contents' => $request->type_content,
            ],
            [
                'name' => 'type_trash',
                'contents' => $request->type_trash,
            ],
        ];

        if ($request->hasFile('image_tumbnail')) {
            $multipart[] = [
                'name' => 'image_tumbnail',
                'contents' => fopen($request->file('image_tumbnail')->getPathname(), 'r'),
                'filename' => $request->file('image_tumbnail')->getClientOriginalName(),
            ];
        }

        if ($request->hasFile('image_content')) {
            $multipart[] = [
                'name' => 'image_content',
                'contents' => fopen($request->file('image_content')->getPathname(), 'r'),
                'filename' => $request->file('image_content')->getClientOriginalName(),
            ];
        }

        try {
            $response = $client->request('POST', env('BASE_URL_API') . 'content/create', [
                'headers' => $headers,
                'multipart' => $multipart,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('content.index')->with('error', 'Data gagal ditambahkan');
        }


        if ($response->getStatusCode() == 200) {
            return redirect()->route('content.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('content.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    public function destroy($id)
    {
        $client = new Client();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
            'API_KEY' => env('API_KEY'),
            'Idempotency-Key' => Str::random(32)
        ];

        try {
            $response = $client->request('DELETE', env('BASE_URL_API') . 'content/delete/' . $id, [
                'headers' => $headers
            ]);
        } catch (\Exception $e) {
            return redirect()->route('content.index')->with('error', 'Data tidak ditemukan');
        }

        if ($response->getStatusCode() == 200) {
            return redirect()->route('content.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('content.index')->with('error', 'Data gagal dihapus');
        }
    }
}
