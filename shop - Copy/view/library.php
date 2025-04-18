<?php
require_once './PHPExcel/Classes/PHPExcel.php'; // điều chỉnh đường dẫn nếu cần

class ExportExcel
{
    public function exportOrders($orders)
    {
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        // Đặt tiêu đề
        $sheet->setCellValue('A1', 'Tên người dùng');
        $sheet->setCellValue('B1', 'Tên sản phẩm');
        $sheet->setCellValue('C1', 'Số lượng');
        $sheet->setCellValue('D1', 'Tổng tiền');
        $sheet->setCellValue('E1', 'Trạng thái');

        $row = 2;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order['username']);
            $sheet->setCellValue('B' . $row, $order['product_name']);
            $sheet->setCellValue('C' . $row, $order['quantity']);
            $sheet->setCellValue('D' . $row, $order['total_price']);
            $sheet->setCellValue('E' . $row, $order['status']);
            $row++;
        }

        // Gửi file về trình duyệt
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="don_hang.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
}
