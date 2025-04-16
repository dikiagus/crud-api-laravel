<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    
    private function parseApiData($data)
    {
        $lines = explode("\n", $data);
        $result = [];

        foreach ($lines as $line) {
            if (empty($line)) continue; // Skip empty lines
            list($ymd, $nama, $nim) = explode('|', $line);
            $result[] = [
                'YMD' => $ymd,
                'NAMA' => $nama,
                'NIM' => $nim,
            ];
        }

        return $result;
    }

    public function searchByName($name)
    {
        $response = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');

        if (!$response->successful()) {
            return response()->json(['message' => 'Failed to fetch data'], 500);
        }

        $data = $response->json();
        if (!isset($data['DATA'])) {
            return response()->json(['message' => 'Invalid data format'], 500);
        }

        $parsedData = $this->parseApiData($data['DATA']);
        $filtered = collect($parsedData)->filter(function ($item) use ($name) {
            return stripos($item['NAMA'], $name) !== false;
        })->values();

        return response()->json($filtered);
    }

    public function searchByNim($nim)
    {
        $response = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');

        if (!$response->successful()) {
            return response()->json(['message' => 'Failed to fetch data'], 500);
        }

        $data = $response->json();
        if (!isset($data['DATA'])) {
            return response()->json(['message' => 'Invalid data format'], 500);
        }

        $parsedData = $this->parseApiData($data['DATA']);
        $filtered = collect($parsedData)->filter(function ($item) use ($nim) {
            return isset($item['NIM']) && intval($item['NIM']) === intval($nim);
        })->values();

        return response()->json($filtered);
    }

    public function searchByYmd($ymd)
    {
        $response = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');

        if (!$response->successful()) {
            return response()->json(['message' => 'Failed to fetch data'], 500);
        }

        $data = $response->json();
        if (!isset($data['DATA'])) {
            return response()->json(['message' => 'Invalid data format'], 500);
        }

        $parsedData = $this->parseApiData($data['DATA']);
        $filtered = collect($parsedData)->filter(function ($item) use ($ymd) {
            return isset($item['YMD']) && $item['YMD'] === $ymd;
        })->values();

        return response()->json($filtered);
    }
}
