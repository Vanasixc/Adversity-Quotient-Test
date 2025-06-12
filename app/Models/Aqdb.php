<?php

namespace App\Models;

use CodeIgniter\Model;

class Aqdb extends Model
{
    public function getQuestionsWithOptions()
    {
        return $this->db->table('questions')
            ->select('questions.id as question_id, questions.question_text, options.id as option_id, options.option_text, options.type')
            ->join('options', 'options.question_id = questions.id')
            ->orderBy('questions.question_order', 'ASC')
            ->get()->getResultArray();
    }

    /**
     * Mengambil semua data dari tabel score_matrix.
     */
    public function getScoreMatrix()
    {
        return $this->db->table('score_matrix')->get()->getResultArray();
    }
}
