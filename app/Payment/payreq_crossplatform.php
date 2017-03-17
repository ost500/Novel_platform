<?php
session_start();
/*
 * [���� ������û ������(STEP2-1)]
 *
 * ���������������� �⺻ �Ķ���͸� ���õǾ� ������, ������ �ʿ��Ͻ� �Ķ���ʹ� �����޴����� �����Ͻþ� �߰� �Ͻñ� �ٶ��ϴ�.
 */

/*
 * 1. �⺻���� ������û ���� ����
 *
 * �⺻������ �����Ͽ� �ֽñ� �ٶ��ϴ�.(�Ķ���� ���޽� POST�� ����ϼ���)
 */
$CST_PLATFORM = $_POST["CST_PLATFORM"];                        //LG���÷��� ���� ���� ����(test:�׽�Ʈ, service:����)
$CST_MID = $_POST["CST_MID"];                             //�������̵�(LG���÷������� ���� �߱޹����� �������̵� �Է��ϼ���)
//�׽�Ʈ ���̵�� 't'�� �ݵ�� �����ϰ� �Է��ϼ���.
$LGD_MID = (("test" == $CST_PLATFORM) ? "t" : "") . $CST_MID;   //�������̵�(�ڵ�����)
$LGD_OID = $_POST["LGD_OID"];                             //�ֹ���ȣ(�������� ����ũ�� �ֹ���ȣ�� �Է��ϼ���)
$LGD_AMOUNT = $_POST["LGD_AMOUNT"];                          //�����ݾ�("," �� ������ �����ݾ��� �Է��ϼ���)
$LGD_BUYER = $_POST["LGD_BUYER"];                           //�����ڸ�
$LGD_PRODUCTINFO = $_POST["LGD_PRODUCTINFO"];                     //��ǰ��
$LGD_BUYEREMAIL = $_POST["LGD_BUYEREMAIL"];                      //������ �̸���
$LGD_TIMESTAMP = date('YmdHis');                                  //Ÿ�ӽ�����
$LGD_OSTYPE_CHECK = "P";                                           //�� P: XPay ����(PC ���� ���): PC��� ����Ͽ� ����� �Ķ���� �� ���μ����� �ٸ��Ƿ� PC���� PC ������������ ���� �ʿ�.
//"P", "M" ���� ����(Null, "" ����)�� ����� �Ǵ� PC ���θ� üũ���� ����
//$LGD_ACTIVEXYN			= "N";											 //������ü ������ ���, ActiveX ��� ���η� "N" �̿��� ��: ActiveX ȯ�濡�� ������ü ���� ����(IE)

$LGD_CUSTOM_SKIN = "red";                                         //�������� ����â ��Ų
$LGD_CUSTOM_USABLEPAY = $_POST["LGD_CUSTOM_USABLEPAY"];                 //����Ʈ �������� (�ش� �ʵ带 ������ ������ �������� ���� UI �� ����˴ϴ�.)
$LGD_WINDOW_VER = "2.5";                                         //����â ��������
$LGD_WINDOW_TYPE = $_POST["LGD_WINDOW_TYPE"];                     //����â ȣ���� (�����Ұ�)
$LGD_CUSTOM_SWITCHINGTYPE = $_POST["LGD_CUSTOM_SWITCHINGTYPE"];            //�ſ�ī�� ī��� ���� ������ ���� ��� (�����Ұ�)
$LGD_CUSTOM_PROCESSTYPE = "TWOTR";                                       //�����Ұ�

/*
 * �������(������) ���� ������ �Ͻô� ��� �Ʒ� LGD_CASNOTEURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�.
 */
$LGD_CASNOTEURL = "http://����URL/cas_noteurl.php";

/*
 * LGD_RETURNURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�. �ݵ�� ���� �������� ������ ����Ʈ�� ��  ȣ��Ʈ�̾�� �մϴ�. �Ʒ� �κ��� �ݵ�� �����Ͻʽÿ�.
 */
$LGD_RETURNURL = "http://����URL/returnurl.php";


$configPath = app_path() . '/Payment';                                  //LG���÷������� ������ ȯ������("/conf/lgdacom.conf") ��ġ ����.


/*
 *************************************************
 * 2. MD5 �ؽ���ȣȭ (�������� ������) - BEGIN
 *
 * MD5 �ؽ���ȣȭ�� �ŷ� �������� �������� ����Դϴ�.
 *************************************************
 *
 * �ؽ� ��ȣȭ ����( LGD_MID + LGD_OID + LGD_AMOUNT + LGD_TIMESTAMP + LGD_MERTKEY )
 * LGD_MID          : �������̵�
 * LGD_OID          : �ֹ���ȣ
 * LGD_AMOUNT       : �ݾ�
 * LGD_TIMESTAMP    : Ÿ�ӽ�����
 * LGD_MERTKEY      : ����MertKey (mertkey�� ���������� -> ������� -> ���������������� Ȯ���ϽǼ� �ֽ��ϴ�)
 *
 * MD5 �ؽ������� ��ȣȭ ������ ����
 * LG���÷������� �߱��� ����Ű(MertKey)�� ȯ�漳�� ����(lgdacom/conf/mall.conf)�� �ݵ�� �Է��Ͽ� �ֽñ� �ٶ��ϴ�.
 */
require_once(app_path() . "/Payment/XPayClient/XPayClient.php");
$xpay = new XPayClient($configPath, $CST_PLATFORM);

if (!$xpay->Init_TX($LGD_MID)) {
    echo "LG���÷������� ������ ȯ�������� ���������� ��ġ �Ǿ����� Ȯ���Ͻñ� �ٶ��ϴ�.<br/>";
    echo "mall.conf���� Mert Id = Mert Key �� �ݵ�� ��ϵǾ� �־�� �մϴ�.<br/><br/>";
    echo "������ȭ LG���÷��� 1544-7772<br/>";
    exit;
}

$LGD_HASHDATA = md5($LGD_MID . $LGD_OID . $LGD_AMOUNT . $LGD_TIMESTAMP . $xpay->config[$LGD_MID]);

/*
 *************************************************
 * 2. MD5 �ؽ���ȣȭ (�������� ������) - END
 *************************************************
 */

$payReqMap['CST_PLATFORM'] = $CST_PLATFORM;                // �׽�Ʈ, ���� ����
$payReqMap['LGD_WINDOW_TYPE'] = $LGD_WINDOW_TYPE;            // �����Ұ�
$payReqMap['CST_MID'] = $CST_MID;                    // �������̵�
$payReqMap['LGD_MID'] = $LGD_MID;                    // �������̵�
$payReqMap['LGD_OID'] = $LGD_OID;                    // �ֹ���ȣ
$payReqMap['LGD_BUYER'] = $LGD_BUYER;                    // ������
$payReqMap['LGD_PRODUCTINFO'] = $LGD_PRODUCTINFO;            // ��ǰ����
$payReqMap['LGD_AMOUNT'] = $LGD_AMOUNT;                    // �����ݾ�
$payReqMap['LGD_BUYEREMAIL'] = $LGD_BUYEREMAIL;                // ������ �̸���
$payReqMap['LGD_CUSTOM_SKIN'] = $LGD_CUSTOM_SKIN;            // ����â SKIN
$payReqMap['LGD_CUSTOM_PROCESSTYPE'] = $LGD_CUSTOM_PROCESSTYPE;        // Ʈ����� ó�����
$payReqMap['LGD_TIMESTAMP'] = $LGD_TIMESTAMP;                // Ÿ�ӽ�����
$payReqMap['LGD_HASHDATA'] = $LGD_HASHDATA;                // MD5 �ؽ���ȣ��
$payReqMap['LGD_RETURNURL'] = $LGD_RETURNURL;                // �������������
$payReqMap['LGD_VERSION'] = "PHP_Non-ActiveX_Standard";    // �������� (�������� ������)
$payReqMap['LGD_CUSTOM_USABLEPAY'] = $LGD_CUSTOM_USABLEPAY;    // ����Ʈ ��������
$payReqMap['LGD_CUSTOM_SWITCHINGTYPE'] = $LGD_CUSTOM_SWITCHINGTYPE;// �ſ�ī�� ī��� ���� ������ ���� ���
$payReqMap['LGD_OSTYPE_CHECK'] = $LGD_OSTYPE_CHECK;        // �� P: XPay ����(PC�� ���� ���), PC, ����� ���� ���������� ��������
//$payReqMap['LGD_ACTIVEXYN']			= $LGD_ACTIVEXYN;			// ������ü ������ ���,ActiveX ��� ����
$payReqMap['LGD_WINDOW_VER'] = $LGD_WINDOW_VER;


// �������(������) ���������� �Ͻô� ���  �Ҵ�/�Ա� ����� �뺸�ޱ� ���� �ݵ�� LGD_CASNOTEURL ������ LG ���÷����� �����ؾ� �մϴ� .
$payReqMap['LGD_CASNOTEURL'] = $LGD_CASNOTEURL;               // ������� NOTEURL

//Return URL���� ���� ��� ���� �� ���õ� �Ķ���� �Դϴ�.*/
$payReqMap['LGD_RESPCODE'] = "";
$payReqMap['LGD_RESPMSG'] = "";
$payReqMap['LGD_PAYKEY'] = "";

$_SESSION['PAYREQ_MAP'] = $payReqMap;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    <title>LG ���÷��� eCredit���� �����׽�Ʈ</title>
    <script language="javascript" src="http://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js"
            type="text/javascript"></script>
    <script type="text/javascript">

        /*
         * �����Ұ�.
         */
        var LGD_window_type = '<?= $LGD_WINDOW_TYPE ?>';

        /*
         * �����Ұ�
         */
        function launchCrossPlatform() {
            lgdwin = openXpay(document.getElementById('LGD_PAYINFO'), '<?= $CST_PLATFORM ?>', LGD_window_type, null, "", "");
        }
        /*
         * FORM ��  ���� ����
         */
        function getFormObject() {
            return document.getElementById("LGD_PAYINFO");
        }

        /*
         * ������� ó��
         */
        function payment_return() {
            var fDoc;

            fDoc = lgdwin.contentWindow || lgdwin.contentDocument;


            if (fDoc.document.getElementById('LGD_RESPCODE').value == "0000") {

                document.getElementById("LGD_PAYKEY").value = fDoc.document.getElementById('LGD_PAYKEY').value;
                document.getElementById("LGD_PAYINFO").target = "_self";
                document.getElementById("LGD_PAYINFO").action = "payres.php";
                document.getElementById("LGD_PAYINFO").submit();
            } else {
                alert("LGD_RESPCODE (����ڵ�) : " + fDoc.document.getElementById('LGD_RESPCODE').value + "\n" + "LGD_RESPMSG (����޽���): " + fDoc.document.getElementById('LGD_RESPMSG').value);
                closeIframe();
            }
        }

    </script>
</head>
<body>
<form method="post" name="LGD_PAYINFO" id="LGD_PAYINFO" action="payres.php">
    <table>
        <tr>
            <td>������ �̸�</td>
            <td><?= $LGD_BUYER ?></td>
        </tr>
        <tr>
            <td>��ǰ����</td>
            <td><?= $LGD_PRODUCTINFO ?></td>
        </tr>
        <tr>
            <td>�����ݾ�</td>
            <td><?= $LGD_AMOUNT ?></td>
        </tr>
        <tr>
            <td>������ �̸���</td>
            <td><?= $LGD_BUYEREMAIL ?></td>
        </tr>
        <tr>
            <td>�ֹ���ȣ</td>
            <td><?= $LGD_OID ?></td>
        </tr>
        <tr>
            <td colspan="2">* �߰� �� ������û �Ķ���ʹ� �޴����� �����Ͻñ� �ٶ��ϴ�.</td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" value="������û" onclick="launchCrossPlatform();"/>
            </td>
        </tr>
    </table>
    <?php
    foreach ($payReqMap as $key => $value) {
        echo "<input type='hidden' name='$key' id='$key' value='$value'>";
    }
    var_dump($_SESSION);
    ?>
</form>
</body>
</html>

