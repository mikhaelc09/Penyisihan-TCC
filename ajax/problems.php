<?php
    require('../util/connection.php');

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }
    $f = $_FILES;
    // print_r($f);

    if($requestType == "uploadExcel"){
        $ext = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
        if(in_array($f["file"]["type"],$ext)){
            $uploadFilePath = '../uploads/'.basename($f['file']['name']);
            move_uploaded_file($f['file']['tmp_name'], $uploadFilePath);

            $fileop = fopen($uploadFilePath, "r");
            $statusOK = true;
            while(! feof($fileop)){
                $row = fgetcsv($fileop);
                if($row[0] != "Question"){
                    $pertanyaan = $row[0] ?? '';
                    $pilihanA = $row[1] ?? '';
                    $pilihanB = $row[2] ?? '';
                    $pilihanC = $row[3] ?? '';
                    $pilihanD = $row[4] ?? '';
                    $pilihanE = $row[5] ?? '';
                    $jawabanBenar = $row[6] ?? '';
                    $durasi = $row[7] ?? '';
                    $gambarSoal = $row[8] ?? '';
    
                    $stmt = $conn->prepare("INSERT INTO soal(pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, durasi, jawaban_benar, quiz_id, gambar_soal) VALUES(?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("ssssssiiis",$pertanyaan, $pilihanA, $pilihanB, $pilihanC, $pilihanD, $pilihanE, $durasi, $jawabanBenar, $quiz_id, $gambarSoal);
                    $statusOK = $statusOK && $stmt->execute();
                }
            }
            fclose($fileop);
                
            if($statusOK) echo "Upload Done!";
            else "There may be something faulty";
        }
        else{
            echo "File is not supported!";
        }
    }
    else if($requestType == "fetchProblem"){
        $stmt = $conn->prepare("SELECT * FROM soal WHERE quiz_id=$quiz_id");
        $stmt->execute(); 
        $probs= $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($probs as $key => $value) {
            echo "<div class='w-full h-1/4 bg-tcc-emerald px-5 py-5 border-4 border-tcc-darkEmerald rounded-lg my-3'>";
                echo (strlen($value["gambar_soal"])>0)?"<div class='h-52 ' style='background-image:url(".$value["gambar_soal"]."); background-size:contain; background-repeat:no-repeat;'></div>":"";
                echo "<h1 class='text-xl font-bold'>".$value["pertanyaan"]."</h1>";
                echo "<div class=' grid grid-cols-12 py-1'>";
                    echo (substr($value["pilihan_a"],0,4)=="http")?
                        "<div class='col-span-2'>A. <div class='h-24' style='background-image:url(".$value["pilihan_a"]."); background-size:contain; background-repeat:no-repeat'></div></div>":
                        "<div class='col-span-2'>A. ".$value["pilihan_a"]."</div>";
                    echo (substr($value["pilihan_b"],0,4)=="http")?
                        "<div class='col-span-2'>B. <div class='h-24' style='background-image:url(".$value["pilihan_b"]."); background-size:contain; background-repeat:no-repeat'></div></div>":
                        "<div class='col-span-2'>B. ".$value["pilihan_b"]."</div>";
                    echo (substr($value["pilihan_c"],0,4)=="http")?
                        "<div class='col-span-2'>C. <div class='h-24' style='background-image:url(".$value["pilihan_c"]."); background-size:contain; background-repeat:no-repeat'></div></div>":
                        "<div class='col-span-2'>C. ".$value["pilihan_c"]."</div>";
                    echo (substr($value["pilihan_d"],0,4)=="http")?
                        "<div class='col-span-2'>D. <div class='h-24' style='background-image:url(".$value["pilihan_d"]."); background-size:contain; background-repeat:no-repeat'></div></div>":
                        "<div class='col-span-2'>D. ".$value["pilihan_d"]."</div>";
                    echo (substr($value["pilihan_e"],0,4)=="http")?
                        "<div class='col-span-2'>E. <div class='h-24' style='background-image:url(".$value["pilihan_e"]."); background-size:contain; background-repeat:no-repeat'></div></div>":
                        "<div class='col-span-2'>E. ".$value["pilihan_e"]."</div>";
                echo "</div>";
                echo "<h2 class='text-lg py-2'>Correct Answer : ".$value["jawaban_benar"]."</h2>";
                echo "<h2 class='text-lg py-2'>Duration : ".$value["durasi"]."</h2>";
            echo "</div>";
        }
    }
?>