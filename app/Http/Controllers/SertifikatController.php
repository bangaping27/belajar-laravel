<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Sertifikat;

class SertifikatController extends Controller
{
    public function index()
    {
        return view('sertifikat.form');
    }

    public function prosess(Request $request)
    {
        $nama = $request->nama;
        $output = public_path().'aping.pdf';
        $this->sertifikat(public_path().'\master\aping.pdf', $nama, $output);

        return response()->file($output);
    }

    public function sertifikat($file, $nama, $output)
    {
        // Inisialisasi objek Fpdi
        $pdf = new Fpdi();
        $pdf->setSourceFile($file);
        $template = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($template);
        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
        $pdf->useTemplate($template);
        $top = 120;
        $right = 98;
        $name = $nama;
        $random = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $Date= date('Y-m-d');
        $code = "$Date - $random";
        $pdf->SetFont('Arial', 'B', 45);
        $pdf->SetTextColor(25, 26, 25);
        $pdf->Text($right, $top, $name);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Text($right, $top + 40, $code);
        $pdf->Image('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$random.'&choe=UTF-8', 150, 150, 50, 50, 'PNG');
        $savedb = new Sertifikat;
        $savedb->nama = $nama;
        $savedb->code = $random;
        $savedb->save();
    
        return $pdf->Output('F', $output);
    }
    public function showVerificationPage()
    {
        return view('sertifikat.verifikasi');
    }

    public function verifyCertificate(Request $request)
    {
        $kode = $request->input('kode');

        $sertifikat = Sertifikat::where('code', $kode)->first();

        if ($sertifikat) {
            $msg = 'Sertifikat atas nama '.$sertifikat->nama.' ditemukan';
            return view('sertifikat.verifikasi', compact('msg'));
        } else {
            $msg = 'Sertifikat dengan code '.$kode.' tidak ditemukan';
            return view('sertifikat.verifikasi', compact('msg'));
        }
    }
}
