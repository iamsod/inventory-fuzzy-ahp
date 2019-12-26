<?php
session_start();
ob_start();
require_once '../helper/util.php';
require_once '../applications/admin/menu_pengembalian/Pengembalian_CRUD.php';
$Pengembalian = new Pengembalian_CRUD();
$Pengembalian->no_bppm = $_SESSION['print_pengembalian'];
@$detil_pengembalian = $Pengembalian->getDetilPengembalianByNoBppm();
@$pengembalian = $Pengembalian->getDataPengembalianByNoBppm();
$jml_item = $detil_pengembalian->num_rows;
$page = $jml_item / 6;

?>
<style>
    th,
    td {
        padding: 7px;
    }

    table {
        table-layout: fixed;
    }

    table td {
        overflow: hidden;
    }
</style>
<?php for ($k = 0; $k < $page; $k++) : ?>
    <page backleft="10mm" backright="10mm" backtop="5mm" style="font-size:12px">
        <div style="height:100px;">
            <div style="font-size:20px">
                PT. Surya Madistrindo
            </div>
            <table align="right">
                <tr>
                    <td>
                        <div style="display: inline-block;word-wrap: break-word;margin-right:100px">
                            Dicetak Oleh<span style="margin-left: 12mm;">:</span> <?= $_SESSION['user']['nama'] ?>
                        </div>
                    </td>
                    <td style="margin-left:10px">
                        Tgl. <?= date('d-M-Y') . ' Pkl. ' . date('H:m:s') ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="display: inline-block;word-wrap: break-word;margin-right:100px">
                            No. BPPM<span style="margin-left: 15mm;">:</span> <?= $pengembalian['no_bppm'] ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="height:50px">
            <div style="font-size:20px;margin:0px 200px">
                BON PENGAMBILAN DAN PENGEMBALIAN MATERI PROMOSI
            </div>
        </div>
        <div style="height:50px">
            <table align="left">
                <tr>
                    <td>
                        <div style="display: inline-block;word-wrap: break-word;margin-right:300px">
                            Nama<span style="margin-left: 34.2mm;">:</span> <?= $pengembalian['nama_pembuat'] ?>
                        </div>
                    </td>
                    <!-- <td style="margin-left:10px">
                    <div style="display: inline-block;word-wrap: break-word;margin-right:300px">
                        TO/DO/RO<span style="margin-left: 12mm;">:</span> fewafoaewjfoiawjjjjjjjjjjjjjjjjjjj
                    </div>
                </td> -->
                </tr>
                <tr>
                    <td>
                        <div style="display: inline-block;word-wrap: break-word;margin-right:100px">
                            Tanggal Penggunaan<span style="margin-left: 15mm;">:</span> <?= formatTanggal($pengembalian['tgl_penggunaan']) ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- <div style="height:400px"> -->
        <div style="padding-left:50px;margin-top:20px">
            <table border="0.5" cellspacing="0" style="table-layout: fixed">
                <tr>
                    <th rowspan="2">Kode item</th>
                    <th rowspan="2" style="width:400px">Deskripsi item</th>
                    <th colspan="2" align="center">Jml</th>
                    <th rowspan="2">Jual Qty</th>
                    <th rowspan="2">Konsumsi Qty</th>
                    <th rowspan="2">Rusak Qty</th>
                    <th colspan="2" align="center">Kembali Qty</th>
                </tr>
                <tr>
                    <th>Baru</th>
                    <th>Bekas</th>
                    <th>Baru</th>
                    <th>Bekas</th>
                </tr>
                <tbody>
                    <?php $tot = 6; $start = 0;?>
                    <?php foreach ($detil_pengembalian as $detil_pengembalian) : ?>
                        <?php if ($start < $jml_item) : ?>
                            <tr>
                                <td><?= $detil_pengembalian['kode'] ?></td>
                                <td style="width:400px"><?= $detil_pengembalian['nama'] ?></td>
                                <td><?= $detil_pengembalian['brg_sblum_baru'] ?></td>
                                <td><?= $detil_pengembalian['brg_sblum_bekas'] ?></td>
                                <td><?= $detil_pengembalian['jml_jual'] ?></td>
                                <td><?= $detil_pengembalian['konsumsi'] ?></td>
                                <td><?= $detil_pengembalian['brg_rusak'] ?></td>
                                <td><?= $detil_pengembalian['brg_baru_kembali'] ?></td>
                                <td><?= $detil_pengembalian['brg_bekas_kembali'] ?></td>
                            </tr>
                            <?php $start += 1; unset($detil_pengembalian[$start]); ?>
                        <?php else : ?>
                            <tr>
                                <td style="padding: 13px"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
                <?php $detil_pengembalian = array_values($detil_pengembalian);
                    $jml_item = $jml_item - $start ?>
            </table>
            <table border="0.5" cellspacing="0">
                <tr>
                    <td style="width:279px;height:200px">Kembali tanggal : <?= formatTanggal($pengembalian['tgl_pengembalian']) ?><br><br>Penanggung jawab gudang<br><br><br>Yang menerima<br><br><br>Yang mengembalikan<br><br><br>Atasan Langsung</td>
                    <td style="width:220px;height:200px">Catatan :<br><br><br><br><br><br><br><br><br><br><br><br><br></td>
                    <?php

                        ?>
                    <td style="width:300px;height:200px">Diambil tanggal :<br><br><br><br>Penanggung jawab gudang<br><br><br>Yang menyerahkan<br><br><br>Yang menerima<br><br><br><br></td>
                </tr>
            </table>
        </div>
        <!-- </div> -->
        <page_footer align="right" style="font-size: 12px;">
            Page [[page_cu]] of [[page_nb]]
        </page_footer>
    </page>
<?php endfor; ?>
<?php
try {
    $html = ob_get_contents();
    require_once '../plugins/html2pdf/html2pdf.class.php';
    $pdf = new HTML2PDF('L', 'A4', 'en', true, 'UTF-8');
    $pdf->setTestTdInOnePage(false);
    $pdf->setDefaultFont('times', 12);
    $pdf->writeHTML($html);
    ob_end_clean();
    $pdf->Output('pengembalian.pdf', 'I');
} catch (HTML2PDF_exception $th) {
    echo $th->getMessage();
}
unset($_SESSION['print_pengembalian']);
