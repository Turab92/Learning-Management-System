<?php
include ('include/function.php');
if(isset($_GET['user_id']))
    {
        echo  $user_id = $_GET['user_id'];
        $up_mc = "DELETE FROM `portal_user` WHERE user_id='$user_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'create_user.php';\");</script>";
    }
if(isset($_GET['m_id']))
    {
        echo  $m_id = $_GET['m_id'];
        $up_mc = "DELETE FROM `main_menu` WHERE m_id='$m_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'create_main_menu.php';\");</script>";
    }
if(isset($_GET['report_id']))
    {
        echo  $report_id = $_GET['report_id'];
        $up_mc = "DELETE FROM `user_reports` WHERE report_id='$report_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'create_reports.php';\");</script>";
    }
if(isset($_GET['allot__id']))
    {
        echo  $allot__id = $_GET['allot__id'];
        $up_mc = "DELETE FROM `allot_main_menu` WHERE allot__id='$allot__id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'menu_alloting.php';\");</script>";
    }
if(isset($_GET['SESSION_ID']))
    {
        echo  $SESSION_ID = $_GET['SESSION_ID'];
        $up_mc = "DELETE FROM `sessions_setup` WHERE SESSION_ID='$SESSION_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'session_setup.php';\");</script>";
    }
if(isset($_GET['branch_id']))
    {
        echo  $branch_id = $_GET['branch_id'];
        $up_mc = "DELETE FROM `school_branches` WHERE branch_id='$branch_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'main_branch_setup.php';\");</script>";
    }
if(isset($_GET['CLASS_ID']))
    {
        echo  $CLASS_ID = $_GET['CLASS_ID'];
        $up_mc = "DELETE FROM `class_setup` WHERE CLASS_ID='$CLASS_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'class.php';\");</script>";
    }
if(isset($_GET['G_ID']))
    {
        echo  $G_ID = $_GET['G_ID'];
        $up_mc = "DELETE FROM `gender_setup` WHERE G_ID='$G_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'gender.php';\");</script>";
    }
if(isset($_GET['allot_id']))
    {
        echo  $allot_id = $_GET['allot_id'];
        $up_mc = "DELETE FROM `allot_report_user` WHERE allot_id='$allot_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'report_alloting';\");</script>";
    }
if(isset($_GET['REG_ID']))
    {
        echo  $REG_ID = $_GET['REG_ID'];
        $up_mc = "DELETE FROM `religion_setup` WHERE REG_ID='$REG_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'religion.php';\");</script>";
    }
if(isset($_GET['SECTION_ID']))
    {
        echo  $SECTION_ID = $_GET['SECTION_ID'];
        $up_mc = "DELETE FROM `class_setup_section` WHERE SECTION_ID='$SECTION_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'section.php';\");</script>";
    }
if(isset($_GET['ALLOT_ID']))
    {
        echo  $ALLOT_ID = $_GET['ALLOT_ID'];
        $up_mc = "DELETE FROM `class_branch_setup` WHERE ALLOT_ID='$ALLOT_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'class_branch_setup.php';\");</script>";
    }
if(isset($_GET['C_ID']))
    {
        echo  $C_ID = $_GET['C_ID'];
        $up_mc = "DELETE FROM `class_sections_capacity` WHERE C_ID='$C_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'class_section_capacity.php';\");</script>";
    }
if(isset($_GET['TYPE_ID']))
    {
        echo  $TYPE_ID = $_GET['TYPE_ID'];
        $up_mc = "DELETE FROM `employee_type_setup` WHERE TYPE_ID='$TYPE_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'employee_type_setup.php';\");</script>";
    }
if(isset($_GET['DESIGNATION_ID']))
    {
        echo  $DESIGNATION_ID = $_GET['DESIGNATION_ID'];
        $up_mc = "DELETE FROM `designation` WHERE DESIGNATION_ID='$DESIGNATION_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'designation.php';\");</script>";
    }
if(isset($_GET['DEPARTMENT_ID']))
    {
        echo  $DEPARTMENT_ID = $_GET['DEPARTMENT_ID'];
        $up_mc = "DELETE FROM `department` WHERE DEPARTMENT_ID='$DEPARTMENT_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'department.php';\");</script>";
    }
if(isset($_GET['emp_allot_id']))
    {
        echo  $emp_allot_id = $_GET['emp_allot_id'];
        $up_mc = "DELETE FROM `employees_current_branch` WHERE ALLOT_ID='$emp_allot_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'employee_branch_setup.php';\");</script>";
    }
if(isset($_GET['allowance_id']))
    {
        echo  $allowance_id = $_GET['allowance_id'];
        $up_mc = "DELETE FROM `allowances` WHERE allowance_id='$allowance_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'allowance.php';\");</script>";
    }
if(isset($_GET['qualification_id']))
    {
        echo  $qualification_id = $_GET['qualification_id'];
        $up_mc = "DELETE FROM `qualification` WHERE qualification_id='$qualification_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'employee_qualification.php';\");</script>";
    }
if(isset($_GET['grade_id']))
    {
        echo  $grade_id = $_GET['grade_id'];
        $up_mc = "DELETE FROM `employee_grade` WHERE grade_id='$grade_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'grade_setup.php';\");</script>";
    }
if(isset($_GET['leave_type_id']))
    {
        echo  $leave_type_id = $_GET['leave_type_id'];
        $up_mc = "DELETE FROM `leave_type` WHERE leave_type_id='$leave_type_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'leave.php';\");</script>";
    }
if(isset($_GET['sub_type_id']))
    {
        echo  $sub_type_id = $_GET['sub_type_id'];
        $up_mc = "DELETE FROM `subject_type` WHERE sub_type_id='$sub_type_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'subject_type_setup.php';\");</script>";
    }
if(isset($_GET['sub_id']))
    {
        echo  $sub_id = $_GET['sub_id'];
        $up_mc = "DELETE FROM `subjects` WHERE sub_id='$sub_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'subjects.php';\");</script>";
    }
if(isset($_GET['doc_id']))
    {
        echo  $doc_id = $_GET['doc_id'];
        $up_mc = "DELETE FROM `documents` WHERE doc_id='$doc_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'document_setup.php';\");</script>";
    }
if(isset($_GET['assign_sub_id']))
    {
        echo  $assign_sub_id = $_GET['assign_sub_id'];
        $up_mc = "DELETE FROM `class_subject_assign` WHERE assign_sub_id='$assign_sub_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'class_subject.php';\");</script>";
    }
if(isset($_GET['period_id']))
    {
        echo  $period_id = $_GET['period_id'];
        $up_mc = "DELETE FROM `period_setup` WHERE period_id='$period_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'period_setup.php';\");</script>";
    }
if(isset($_GET['emp_right_id']))
    {
        echo  $emp_right_id = $_GET['emp_right_id'];
        $up_mc = "DELETE FROM `employee_right` WHERE emp_right_id='$emp_right_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'edit_delete_rights.php';\");</script>";
    }
if(isset($_GET['assign_leave_id']))
    {
        echo  $assign_leave_id = $_GET['assign_leave_id'];
        $up_mc = "DELETE FROM `assign_leave` WHERE assign_leave_id='$assign_leave_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'assign_leaves.php';\");</script>";
    }
if(isset($_GET['emp_allow_id']))
    {
        echo  $emp_allow_id = $_GET['emp_allow_id'];
        $up_mc = "DELETE FROM `employee_allowances` WHERE emp_allow_id='$emp_allow_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'allowance_detail.php';\");</script>";
    }
if(isset($_GET['EMP_ID']))
    {
        echo  $EMP_ID = $_GET['EMP_ID'];
        $up_mc = "UPDATE `employees` SET  STATUS = 'N' WHERE EMP_ID='$EMP_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'view_employee_profile.php';\");</script>";
    }
if(isset($_GET['std_doc_id']))
    {
        echo  $std_doc_id = $_GET['std_doc_id'];
        $up_mc = "DELETE FROM `student_doc_attached` WHERE std_doc_id='$std_doc_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'document.php';\");</script>";
    }
if(isset($_GET['bearer_id']))
    {
        echo  $bearer_id = $_GET['bearer_id'];
        $up_mc = "DELETE FROM `student_current_bearer` WHERE bearer_id='$bearer_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'bearer.php';\");</script>";
    }
if(isset($_GET['parent_cont_id']))
    {
        echo  $parent_cont_id = $_GET['parent_cont_id'];
        $up_mc = "DELETE FROM `student_parent_contact` WHERE parent_cont_id='$parent_cont_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'house.php';\");</script>";
    }
if(isset($_GET['std_prev_id']))
    {
        echo  $std_prev_id = $_GET['std_prev_id'];
        $up_mc = "DELETE FROM `student_previous_detail` WHERE std_prev_id='$std_prev_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'prev_docs.php';\");</script>";
    }
if(isset($_GET['NATURE_ID']))
    {
        echo  $NATURE_ID = $_GET['NATURE_ID'];
        $up_mc = "DELETE FROM `nature_payments` WHERE NATURE_ID='$NATURE_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'nature.php';\");</script>";
    }
if(isset($_GET['UNIT_ID']))
    {
        echo  $UNIT_ID = $_GET['UNIT_ID'];
        $up_mc = "DELETE FROM `payment_frequency_unit` WHERE UNIT_ID='$UNIT_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'payment_frequency.php';\");</script>";
    }
if(isset($_GET['MODE_ID']))
    {
        echo  $MODE_ID = $_GET['MODE_ID'];
        $up_mc = "DELETE FROM `payment_mode` WHERE MODE_ID='$MODE_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'payment_mode.php';\");</script>";
    }
if(isset($_GET['CHARGE_TYPE_ID']))
    {
        echo  $CHARGE_TYPE_ID = $_GET['CHARGE_TYPE_ID'];
        $up_mc = "DELETE FROM `charges_types` WHERE CHARGE_TYPE_ID='$CHARGE_TYPE_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'charges.php';\");</script>";
    }
if(isset($_GET['ACCOUNT_TYPE']))
    {
        echo  $ACCOUNT_TYPE = $_GET['ACCOUNT_TYPE'];
        $up_mc = "DELETE FROM `account_types` WHERE ACCOUNT_TYPE='$ACCOUNT_TYPE'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'account_types';\");</script>";
    }
if(isset($_GET['ACC_DETAIL_TYPE']))
    {
        echo  $ACC_DETAIL_TYPE = $_GET['ACC_DETAIL_TYPE'];
        $up_mc = "DELETE FROM `account_types_detail` WHERE ACC_DETAIL_TYPE='$ACC_DETAIL_TYPE'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'coan';\");</script>";
    }
if(isset($_GET['HEAD_CODE']))
    {
        echo  $HEAD_CODE = $_GET['HEAD_CODE'];
        $up_mc = "DELETE FROM `chart_head` WHERE HEAD_CODE='$HEAD_CODE'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'coan2';\");</script>";
    }
if(isset($_GET['del']) && ($_GET['del2']))
    {
       
		echo $CHART_HEAD_CODE = $_GET['del'];
		echo $CHART_ACC_CODE = $_GET['del2'];
        $up_mc = "DELETE FROM `chart_detail` WHERE CHART_HEAD_CODE='$CHART_HEAD_CODE' and CHART_ACC_CODE='$CHART_ACC_CODE'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'coan3';\");</script>";
    }
if(isset($_GET['TR_NO']))
    {
        echo  $TR_NO = $_GET['TR_NO'];
        $up_mc = "DELETE FROM `chart_detail_company` WHERE TR_NO='$TR_NO'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'coan4';\");</script>";
    }
if(isset($_GET['project_TR_NO']))
    {
        echo  $project_TR_NO = $_GET['project_TR_NO'];
        $up_mc = "DELETE FROM `chart_detail_project` WHERE TR_NO='$project_TR_NO'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'coan5';\");</script>";
    }
if(isset($_GET['VOUCHER_TYPE_ID']))
    {
        echo  $VOUCHER_TYPE_ID = $_GET['VOUCHER_TYPE_ID'];
        $up_mc = "DELETE FROM `voucher_types` WHERE VOUCHER_TYPE_ID='$VOUCHER_TYPE_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'voucher_types';\");</script>";
    }
if(isset($_GET['SNO']))
    {
        echo  $SNO = $_GET['SNO'];
        $up_mc = "DELETE FROM `fiscal_year` WHERE SNO='$SNO'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'fiscal_year';\");</script>";
    }
if(isset($_GET['SUPPLIER_TYPE_ID']))
    {
        echo  $SUPPLIER_TYPE_ID = $_GET['SUPPLIER_TYPE_ID'];
        $up_mc = "DELETE FROM `supplier_type` WHERE SUPPLIER_TYPE_ID='$SUPPLIER_TYPE_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'supplier_type';\");</script>";
    }
if(isset($_GET['SUPPLIER_ID']))
    {
        echo  $SUPPLIER_ID = $_GET['SUPPLIER_ID'];
        $up_mc = "DELETE FROM `supplier_setup` WHERE SUPPLIER_ID='$SUPPLIER_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'supplier_setup';\");</script>";
    }
if(isset($_GET['CLASSIC_ID']))
    {
        echo  $CLASSIC_ID = $_GET['CLASSIC_ID'];
        $up_mc = "DELETE FROM `classification_description` WHERE CLASSIC_ID='$CLASSIC_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'classification_description';\");</script>";
    }
if(isset($_GET['CLASSIC_DETAIL_ID']))
    {
        echo  $CLASSIC_DETAIL_ID = $_GET['CLASSIC_DETAIL_ID'];
        $up_mc = "DELETE FROM `class_description_detail` WHERE CLASSIC_DETAIL_ID='$CLASSIC_DETAIL_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'classification_description_detail';\");</script>";
    }
if(isset($_GET['allot_item_id']))
    {
        echo  $allot_item_id = $_GET['allot_item_id'];
        $up_mc = "DELETE FROM `allot_items` WHERE TR_NO='$allot_item_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'allot_items';\");</script>";
    }
if(isset($_GET['allot_supplier_id']))
    {
        echo  $allot_supplier_id = $_GET['allot_supplier_id'];
        $up_mc = "DELETE FROM `allot_supplier_setup` WHERE TR_NO='$allot_supplier_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'allot_supplier';\");</script>";
    }
if(isset($_GET['UOM_ID']))
    {
        echo  $UOM_ID = $_GET['UOM_ID'];
        $up_mc = "DELETE FROM `uom_setup` WHERE UOM_ID='$UOM_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'uom';\");</script>";
    }
if(isset($_GET['TERM_ID']))
    {
        echo  $TERM_ID = $_GET['TERM_ID'];
        $up_mc = "DELETE FROM `payment_terms` WHERE TERM_ID='$TERM_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'payment_terms';\");</script>";
    }
if(isset($_GET['POPRIORITY_ID']))
    {
        echo  $POPRIORITY_ID = $_GET['POPRIORITY_ID'];
        $up_mc = "DELETE FROM `popriority_setup` WHERE POPRIORITY_ID='$POPRIORITY_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'popriority';\");</script>";
    }
if(isset($_GET['item_id']))
    {
        echo  $item_id = $_GET['item_id'];
        $up_mc = "DELETE FROM `item_setup2` WHERE ITEM_ID='$item_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'item_setup';\");</script>";
    }
if(isset($_GET['POTYPE_ID']))
    {
        echo  $POTYPE_ID = $_GET['POTYPE_ID'];
        $up_mc = "DELETE FROM `potype_setup` WHERE POTYPE_ID='$POTYPE_ID'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'potype';\");</script>";
    }
if(isset($_GET['bank_assign_id']))
    {
        echo  $bank_assign_id = $_GET['bank_assign_id'];
        $up_mc = "DELETE FROM `bank_assign_branch` WHERE bank_assign_id='$bank_assign_id'";
            $run_mc=mysqli_query($conn,$up_mc);
         alert_box('Deleted Successfully');
        echo "<script>setTimeout(\"location.href = 'bank_assign_branch.php';\");</script>";
    }
?>