<?php

function generate_password() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
    $alphabet .= "0123456789";
    $alphabet .= "!@#$%()";

    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 32; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function copy_dir($from, $to) {
    foreach (
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($from), \RecursiveIteratorIterator::SELF_FIRST) as $item
    ) {
        if ($item->isDir() && !is_dir($to . DIRECTORY_SEPARATOR . $iterator->getSubPathName())) {
            mkdir($to . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
        } elseif (!$item->isDir()) {
            copy($item, $to . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
        }
    }

}

function remove_dir($dir, $log = false) {
    $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($files as $file) {
        if ($file->isDir()) {
            if ($log) {
                echo "<p class=\"text-remove\">Removendo pasta {$file->getRealPath()}...</p>";
                ob_flush();
                flush();
            }

            rmdir($file->getRealPath());
        } else {
            if ($log) {
                echo "<p class=\"text-remove\">Removendo arquivo {$file->getRealPath()}...</p>";
                ob_flush();
                flush();
            }

            unlink($file->getRealPath());
        }
    }

    if ($log) {
        echo "<p class=\"text-remove\">Removendo pasta {$dir}...</p>";
        ob_flush();
        flush();
    }

    rmdir($dir);
}

function zip($source, $destination) {
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..'))) {
                continue;
            }

            $file = realpath($file);

            if (is_dir($file) === true) {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            } else if (is_file($file) === true) {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    } else if (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

function genLicense() {
    $seed = array(
        0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G', 7 => 'H',
        8 => 'I', 9 => 'J', 10 => 'K', 11 => 'L', 12 => 'M', 13 => 'N', 14 => 'O',
        15 => 'P', 16 => 'Q', 17 => 'R', 18 => 'S', 19 => 'T', 20 => 'U', 21 => 'V',
        22 => 'W', 23 => 'X', 24 => 'Y', 25 => 'Z'
    );
    shuffle($seed);

    $block = 'LGDPM';
    $block .= $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)];
    $block .= date('i') . $seed[rand(0, 25)] . date('m');
    $block .= $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)];
    $block .= date('y') . $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)];
    $block .= $seed[rand(0, 25)] . rand(0, 9) . rand(0, 9) . $seed[rand(0, 25)] . $seed[rand(0, 25)];



    return $block;
}

function getToken($license) {
    return md5($license);
}

function getUpdateToken() {
    require('./getPass.class.php');
    
    $seed = array(
        0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G', 7 => 'H',
        8 => 'I', 9 => 'J', 10 => 'K', 11 => 'L', 12 => 'M', 13 => 'N', 14 => 'O',
        15 => 'P', 16 => 'Q', 17 => 'R', 18 => 'S', 19 => 'T', 20 => 'U', 21 => 'V',
        22 => 'W', 23 => 'X', 24 => 'Y', 25 => 'Z'
    );
    shuffle($seed);

    $block = 'UPDTE';
    $block .= $seed[rand(0, 25)] . date('y') . date('m');
    $block .= $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)] . $seed[rand(0, 25)];
    $block .= date('i') . $seed[rand(0, 25)] . rand(0, 9) . rand(0, 9);
    
    $encrypt = new getPass();
    
    return $encrypt->encrypt($block);
}

function get_month($num) {
    switch ($num) {
    case '01':
        return 'Janeiro';
        break;
    case '02':
        return 'Fevereiro';
        break;
    case '03':
        return 'Março';
        break;
    case '04':
        return 'Abril';
        break;
    case '05':
        return 'Maio';
        break;
    case '06':
        return 'Junho';
        break;
    case '07':
        return 'Julho';
        break;
    case '08':
        return 'Agosto';
        break;
    case '09':
        return 'Setembro';
        break;
    case '10':
        return 'Outubro';
        break;
    case '11':
        return 'Novembro';
        break;
    case '12':
        return 'Dezembro';
        break;
    default:
        return false;
        break;
    }
}