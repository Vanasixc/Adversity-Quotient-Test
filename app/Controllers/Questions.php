<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Aqdb;

class Questions extends BaseController
{
    public function getIndex()
    {
        return view('aq/pages/questions_v');
    }

    /**
     * Method ini akan menjadi API untuk diambil oleh JavaScript.
     * Tugasnya adalah mengambil data soal dari database dan menyajikannya dalam format JSON.
     */
    public function getApiquestions()
    {
        $Aqdb = new Aqdb();
        $rawData = $Aqdb->getQuestionsWithOptions();

        // Proses data mentah dari database menjadi format yang diinginkan JavaScript
        $questions = [];
        foreach ($rawData as $row) {
            $questionId = $row['question_id'];

            // Jika pertanyaan belum ada di array, tambahkan
            if (!isset($questions[$questionId])) {
                $questions[$questionId] = [
                    'question' => $row['question_text'],
                    'options' => [],
                ];
            }

            // Tambahkan pilihan jawaban ke pertanyaan yang sesuai
            $questions[$questionId]['options'][] = [
                'text' => $row['option_text'],
                'type' => $row['type'],
            ];
        }

        // Mengembalikan data dalam format JSON, dan mereset key array
        return $this->response->setJSON(array_values($questions));
    }

    /**
     * Method ini juga menjadi API untuk mengambil data score_matrix.
     */
    public function getMatrix()
    {
        $Aqdb = new Aqdb();
        $matrixData = $Aqdb->getScoreMatrix();

        // Ubah format matrix agar mudah digunakan di JavaScript
        $matrix = [];
        foreach ($matrixData as $row) {
            $key = "{$row['score_q']}_{$row['score_ca']}_{$row['score_cl']}";
            $matrix[$key] = $row['result_type'];
        }

        return $this->response->setJSON($matrix);
    }
}
