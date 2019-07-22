<h2>Check Domain Availability</h2>

<form action="" method=post>
    <table>
        <tr>
            <td>Enter Domain Name:</td>
            <td> : <textarea type="text" name="domain_name"></textarea></td>
        <tr>
            <td align="right" colspan="3"><input type="submit" name="check" value="Check"></td>
        </tr>
        </tr>
    </table>
</form>

<?php

if (isset($_POST['check'])) {
    $available = fopen("available.txt", "w");
    $taken = fopen("hastaken.txt", "w");
    if (!empty($_POST['domain_name'])) {
        $name_domain = $_POST['domain_name'];

        $postDatas = (explode(',',$name_domain,1000)) ;
        foreach ($postDatas as $postData){
            $response = @dns_get_record($postData, DNS_ALL);
            if (empty($response)) {
                echo "<pre>";
                fwrite($available, $postData);
                echo "</pre>";
                print_r("<H2 style='color:green;' >Domain $postData is available.</H2>") ;
            }else{
                echo "<pre>";
                fwrite($taken, $postData);
                echo "</pre>";
                print_r ("<H2 style='color:red;'>Domain $postData has taken.</H2>");
            }
        }


    } else {
        echo "<H2 style='color:red;'>Error: Domain name can not be left empty.</H2>";
    }
}
?>
