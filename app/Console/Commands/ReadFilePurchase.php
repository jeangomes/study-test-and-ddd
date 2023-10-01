<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReadFilePurchase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:file-purchase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        //$this->applyRegex();
        //dd(85);
        //////////////////////////
        $filename = resource_path('compra-sacolao-13-05-2023.txt');
        $file = fopen( $filename, "r" );

        if(!$file) {
            echo ( "Error in opening file" );
            exit();
        }
        $lineCounter = 0;
        $linesToProcess = [];
        $lineFull = '';
        while (!feof($file)) {
            $line = fgets($file);
            if ($line !== false) {
                $lineCounter++;
                $replaceBarraN = str_replace("\n"," ",$line);
                $replaceBarraT = str_replace("\t"," ",$replaceBarraN);
                $lineFull = $lineFull . $replaceBarraT;
                if ($lineCounter == 3) {
                    //dump($lineFull);
                    //$this->info($lineFull);
                    $linesToProcess[] = $lineFull;
                    $lineCounter = 0;
                    $lineFull = '';
                }
            }
        }
        //////////
        fclose( $file );
        $records = [];
        $amount = 0;
        foreach ($linesToProcess as $line){
            dump($line);
            $record = $this->applyRegex($line);
            $records[] = $record;
            $amount= $amount+$record['total_price'];
        }
        $this->table(array_keys($records[0]),$records);

        $this->info('Total: '.$amount);
        //return Command::SUCCESS;
    }

    private function applyRegex($line): array
    {
        $inputString = $line;
// Define a regular expression pattern
        $pattern = '/^(.*?)\s+\(Código:\s+(\d+)\s+\)\s+Qtde\.:(.*?)\s+UN:\s+(.*?)\s+Vl\. Unit\.:\s+([\d,]+)\s+Vl\. Total\s+([\d,]+)\s*$/u';

// Use preg_match to extract data
        if (preg_match($pattern, $inputString, $matches)) {
            $productName = trim($matches[1]);
            $productCode = $matches[2];
            $quantity = str_replace(',', '.', $matches[3]); // Convert ',' to '.' for decimal
            $unitOfMeasurement = trim($matches[4]);
            $unitPrice = (float)str_replace(',', '.', preg_replace('/\s+/', '', $matches[5])); // Remove spaces and replace ',' with '.'
            $totalPrice = (float)str_replace(',', '.', preg_replace('/\s+/', '', $matches[6])); // Remove spaces and replace ',' with '.'

            // Output the extracted data
/*            echo "Product Name: $productName\n";
            echo "Product Code: $productCode\n";
            echo "Quantity: $quantity $unitOfMeasurement\n";
            echo "Unit Price: $unitPrice\n";
            echo "Total Price: $totalPrice\n";*/

            return [
                "product_name" => $productName,
                "product_code" => $productCode,
                "quantity" => $quantity,
                "unit_measure" => $unitOfMeasurement,
                "unit_price" => $unitPrice,
                "total_price" => $totalPrice,
            ];
        } else {
            echo "Failed to extract data from the input string.\n";
            return [];
        }
    }
}
