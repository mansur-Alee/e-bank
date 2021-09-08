<?php
session_start();
include 'db_pdo.php';

$con = $db->open();

try {
    $stmt = $con->prepare("SELECT * FROM transactions INNER JOIN employee ON transactions.emp_id = employee.personalNumber WHERE transactions.emp_id = :id ORDER BY transTime ASC");
    $stmt->execute(["id" => $_POST['reg_number']]);
    $sn = 1;
    $bal = 0;
    $total_dr = 0;
    $total_cr = 0;
    $cr_no = 0;
    $dr_no = 0;

    $output = "
        <table id='myTable'>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $stmt->fetch()) {
        $cr_amt = ($row['transType'] == "credit") ? number_format($row['transaction_amount']) : "";
        $dr_amt = ($row['transType'] == "debit") ? number_format($row['transaction_amount']) : "";
        if ($cr_amt != "" || $dr_amt != "") {
            // $bal = 0;
            if ($row['transType'] == "credit") {
                $bal -= $row['transaction_amount'];
                $total_cr += $row['transaction_amount'];
                $cr_no++;
            } else {
                $bal += $row['transaction_amount'];
                $total_dr += $row['transaction_amount'];
                $dr_no++;
            }
        }
        $output .= "<tr>
                        <td>{$sn}</td>
                        <td>" . date('M d, Y', strtotime($row['transTime'])) . "</td>
                        <td>{$row['firstName']} {$row['middleName']} {$row['Surname']}</td>
                        <td>{$dr_amt}</td>
                        <td>{$cr_amt}</td>
                        <td>" . number_format($bal) . "</td>
                    </tr>";
        $sn++;
        $f_bal = $row['Amount'];
    }
    $t_trans = $cr_no + $dr_no;
    $output .= "</tbody>
        </table>
        <div class='record-success'>
            <p>Total Debits: &#8358;" . number_format($total_dr) . "</p>
            <p>Total Credits: &#8358;" . number_format($total_cr) . "</p>
            <p>Current Balance: &#8358;" . number_format($f_bal) . "</p>
            <p>Total Number of Debits: {$dr_no}</p>
            <p>Total Number of Credits: {$cr_no}</p>
            <p>Total Number of Transactions: {$t_trans}</p>
        </div>
    ";
} catch (PDOException $th) {
    $output = $th->getMessage();
}

echo json_encode($output);
$db->close();
