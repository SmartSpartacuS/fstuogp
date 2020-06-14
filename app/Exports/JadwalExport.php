<?php

namespace App\Exports;

use App\jadwal;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;	
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

// class JadwalExport implements FromCollection, WithDrawings, WithHeadings, WithEvents
class JadwalExport implements FromView, WithDrawings, ShouldAutoSize, WithEvents
{
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo UOGP');
        $drawing->setPath(public_path('images\asset\uogp.jpg'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    private $id_prodi;
    private $semester_ak;
    private $tahun_ak;

    public function __construct($id_prodi,$semester_ak,$tahun_ak)
    {
         $this->id_prodi = $id_prodi;
         $this->semester_ak = $semester_ak;
         $this->tahun_ak = $tahun_ak;
    }


    public function view(): View
    {
        $jadwal = jadwal::where('id_prodi','LIKE',$this->id_prodi)->where('semester_ak',$this->semester_ak)->where('tahun_ak',$this->tahun_ak)->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")')
            ->orderBy('jam_mulai')
            ->get();
        if ($this->id_prodi) {
            $prodi=auth()->user()->dosen->prodi->nm_prodi;
        }else{
            $prodi="FAKULTAS SAINS & TEKNOLOGI";
        }
            
        return view('pekerja.kaprodi.jadwal.data',[
            'jadwal'=>$jadwal,
            'prodi'=>$prodi,
            ]);
    }
    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            AfterSheet::class    => function(AfterSheet $event) {
                
                // Header
                $styleArray = [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['Hex' => '#000000'],
                        ],
                    ],
                ];
                $event->sheet->getDelegate()->getStyle('A1:H2')->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:H2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A4:H5')->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A4:H5')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:H3')->getFont()->setSize(10);
                $event->sheet->getDelegate()->getStyle('A7:H7')->getFont()->setBold(true);
                $event->sheet->getDelegate()->mergeCells('A1:H1');
                $event->sheet->getDelegate()->mergeCells('A2:H2');
                $event->sheet->getDelegate()->mergeCells('A3:H3');
                $event->sheet->getDelegate()->mergeCells('A4:H4');
                $event->sheet->getDelegate()->mergeCells('A5:H5');
                $event->sheet->setFontFamily('A1:AC300', 'Times New Roman');
                $event->sheet->horizontalAlign('A1:H1' , Alignment::HORIZONTAL_CENTER);
                $event->sheet->horizontalAlign('A2:H2' , Alignment::HORIZONTAL_CENTER);
                $event->sheet->horizontalAlign('A3:H3' , Alignment::HORIZONTAL_CENTER);
                $event->sheet->horizontalAlign('A4:H4' , Alignment::HORIZONTAL_CENTER);
                $event->sheet->horizontalAlign('A5:H5' , Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                
                $event->sheet->getDelegate()->getStyle('A3:H3')->applyFromArray($styleArray);

                // Content
                $senin =jadwal::where('id_prodi','LIKE',$this->id_prodi)->where('semester_ak',$this->semester_ak)->where('tahun_ak',$this->tahun_ak)->where('hari', 'Senin')->get();
                $hitungSenin=$senin->count()-1;
                $mulaiSenin=8+$hitungSenin;
                $hitungSenin <= 0 ? $gabungSenin="A8:A8" : $gabungSenin= "A8:A$mulaiSenin";
                
                $selasa =jadwal::where('id_prodi','LIKE',$this->id_prodi)->where('semester_ak',$this->semester_ak)->where('tahun_ak',$this->tahun_ak)->where('hari', 'Selasa')->get();
                $hitungSelasa=$selasa->count()-1;
                $mulaiSelasa=$mulaiSenin+1;
                $selesSelasa=$mulaiSelasa+$hitungSelasa;
                $hitungSelasa <= 0 ? $gabungSelasa=$gabungSenin : $gabungSelasa= "A$mulaiSelasa:A$selesSelasa";

                $Rabu =jadwal::where('id_prodi','LIKE',$this->id_prodi)->where('semester_ak',$this->semester_ak)->where('tahun_ak',$this->tahun_ak)->where('hari', 'Rabu')->get();
                $hitungRabu=$Rabu->count()-1;
                $mulaiRabu=$selesSelasa+1;
                $selesRabu=$mulaiRabu+$hitungRabu;
                $hitungRabu <= 0 ? $gabungRabu=$gabungSelasa : $gabungRabu= "A$mulaiRabu:A$selesRabu";

                $Kamis =jadwal::where('id_prodi','LIKE',$this->id_prodi)->where('semester_ak',$this->semester_ak)->where('tahun_ak',$this->tahun_ak)->where('hari', 'Kamis')->get();
                $hitungKamis=$Kamis->count()-1;
                $mulaiKamis=$selesRabu+1;
                $selesKamis=$mulaiKamis+$hitungKamis;
                $hitungKamis <= 0 ? $gabungKamis=$gabungRabu : $gabungKamis= "A$mulaiKamis:A$selesKamis";

                $Jumat =jadwal::where('id_prodi','LIKE',$this->id_prodi)->where('semester_ak',$this->semester_ak)->where('tahun_ak',$this->tahun_ak)->where('hari', 'Jumat')->get();
                $hitungJumat=$Jumat->count()-1;
                $mulaiJumat=$selesKamis+1;
                $selesJumat=$mulaiJumat+$hitungJumat;
                $hitungJumat <= 0 ? $gabungJumat=$gabungKamis : $gabungJumat= "A$mulaiJumat:A$selesJumat";

                $Sabtu =jadwal::where('id_prodi','LIKE',$this->id_prodi)->where('semester_ak',$this->semester_ak)->where('tahun_ak',$this->tahun_ak)->where('hari', 'Sabtu')->get();
                $hitungSabtu=$Sabtu->count()-1;
                $mulaiSabtu=$selesJumat+1;
                $selesSabtu=$mulaiSabtu+$hitungSabtu;
                $hitungSabtu <= 0 ? $gabungSabtu=$gabungJumat : $gabungSabtu= "A$mulaiSabtu:A$selesSabtu";

                $styleContent = [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];

                $event->sheet->getDelegate()->mergeCells($gabungSenin);
                $event->sheet->getDelegate()->mergeCells($gabungSelasa);
                $event->sheet->getDelegate()->mergeCells($gabungRabu);
                $event->sheet->getDelegate()->mergeCells($gabungKamis);
                $event->sheet->getDelegate()->mergeCells($gabungJumat);
                $event->sheet->getDelegate()->mergeCells($gabungSabtu);
                $event->sheet->getDelegate()->getStyle("A8:A$selesSabtu")->getAlignment()->setTextRotation(90);
                $event->sheet->horizontalAlign("A8:A$selesSabtu" , Alignment::HORIZONTAL_CENTER);


                // $event->sheet->getDelegate()->getStyle('B3:B7')->getFill()
                //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                //     ->getStartColor()->setARGB('FFFF0000');

                $event->sheet->getDelegate()->getStyle("A7:H$selesSabtu")->applyFromArray($styleContent);

            },
        ];
    }

}
