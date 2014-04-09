<?php
include_once 'lib/pagseguro/pgs.php';
include_once 'data/paygateway.php';
include_once 'data/registration.php';

$regdb = new Registration(null);
$paygateway = new PayGateway(null);
$pagseguro = $paygateway->getPagseguro();
$resreg = $regdb->selectById($userid);

$userobj = db_fetch_array($resreg);

$pgs = new pgs(array(
            'email_cobranca' => $pagseguro->getEmail(),
            'tipo' => 'CP',
            'tipo_frete' => $pagseguro->getFreightType(),
            'ref_transacao' => $orderid,
        ));

$pgs->cliente(array(
    'nome' => $userobj['firstname'] . " " . $userobj['lastname'],
    'cep' => $userobj['postcode'],
    'compl' => $userobj['addressline1'],
    'cidade' => $userobj['city'],
    'uf' => $userobj['state'],
    'tel' => $userobj['phone'],
    'email' => $userobj['email'],
));


$pgs->adicionar(array(
    'id' => $itemid,
    'quantidade' => 1,
    'valor' => $amount,
    'descricao' => $itemname . '-' . $itemdescription,
));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?= $AllPageTitle; ?></title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#pagseguro_form').submit();
            });
        </script>
    </head>
    <body>
        <form id="pagseguro_form" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post">
        <?php $pgs->mostra(array('show_submit'=>false,'open_form'=>false,'close_form'=>false)); ?>
        </form>
    </body>
</html>