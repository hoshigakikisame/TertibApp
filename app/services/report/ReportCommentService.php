<?php

class ReportCommentService extends DBService {
    public function __construct()
    {
        parent::__construct('tb_report_comment');
    }

    public static function getInstance(): self
    {
        return parent::getInstance();
    }

    public function getManyReportComment($where): array
    {
        $rawReportComments = $this->getDB()->findMany($this->getTable(), $where, 'id_report_comment', 'ASC');
        $reportComments = [];

        if ($rawReportComments) {
            foreach ($rawReportComments as $rawReport) {
                $reportComments[] = ReportCommentModel::fromStdClass($rawReport);
            }
        }

        return $reportComments;
    }

    public function addNewReportComment(
        $idReport,
        $idUser,
        $content,
        $imagePath,
    ): string {
        $data = [
            'id_report' => $idReport,
            'id_user' => $idUser,
            'content' => $content,
            'image_path' => $imagePath
        ];

        return $this->getDB()->insert($this->getTable(), $data);
    }

    /**
     * @param ReportCommentModel[] $reportComments
     */
    public function markReportCommentAsRead(array $reportComments) {
        $ids = [];
        foreach ($reportComments as $reportComment) {
            $ids[] = $reportComment->getIdReportComment();
        }

        return $this->getDB()->execute("UPDATE {$this->getTable()} SET is_new = false WHERE id_report_comment IN (" . implode(',', $ids) . ")");
    }
}