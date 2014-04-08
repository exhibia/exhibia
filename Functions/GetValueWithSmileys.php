<?php
function GetValueWithSmileys($datavalue) {
    $body = stripslashes($datavalue);

    $body = str_replace(':)', "<img src='../images/smileys/smile.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":(", "<img src='../images/smileys/sad.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":P", "<img src='../images/smileys/tongue.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(";)", "<img src='../images/smileys/wink.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":D", "<img src='../images/smileys/biggrin.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":'(", "<img src='../images/smileys/cry.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("*)", "<img src='../images/smileys/think.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":~", "<img src='../images/smileys/confused.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("8)", "<img src='../images/smileys/shades.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("<)", "<img src='../images/smileys/party.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":$", "<img src='../images/smileys/embarrased.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":@", "<img src='../images/smileys/angry.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":#", "<img src='../images/smileys/keep_quiet.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":O", "<img src='../images/smileys/omg.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("+(", "<img src='../images/smileys/sick.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("|)", "<img src='../images/smileys/sleepy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("^)", "<img src='../images/smileys/sarcy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace(":E", "<img src='../images/smileys/baringteeth.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(L)", "<img src='../images/smileys/heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(l)", "<img src='../images/smileys/heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(U)", "<img src='../images/smileys/broken_heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(u)", "<img src='../images/smileys/broken_heart.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(K)", "<img src='../images/smileys/kiss.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(k)", "<img src='../images/smileys/kiss.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(F)", "<img src='../images/smileys/rose.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(f)", "<img src='../images/smileys/rose.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(B)", "<img src='../images/smileys/beer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(b)", "<img src='../images/smileys/beer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(T)", "<img src='../images/smileys/phone.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(t)", "<img src='../images/smileys/phone.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(P)", "<img src='../images/smileys/pizza.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(p)", "<img src='../images/smileys/pizza.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(M)", "<img src='../images/smileys/mobile.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(m)", "<img src='../images/smileys/mobile.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(th)", "<img src='../images/smileys/thunder.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(Z)", "<img src='../images/smileys/guy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(z)", "<img src='../images/smileys/guy.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(X)", "<img src='../images/smileys/girl.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(x)", "<img src='../images/smileys/girl.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(ii)", "<img src='../images/smileys/cake.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(E)", "<img src='../images/smileys/envelope.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(e)", "<img src='../images/smileys/envelope.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(&#163;)", "<img src='../images/smileys/money.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(S)", "<img src='../images/smileys/soccer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(s)", "<img src='../images/smileys/soccer.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(C)", "<img src='../images/smileys/coffee.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(c)", "<img src='../images/smileys/coffee.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(Y)", "<img src='../images/smileys/thumbs_up.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(y)", "<img src='../images/smileys/thumbs_up.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(N)", "<img src='../images/smileys/thumbs_down.gif' width='19' height='19' align='absmiddle' />", $body);
    $body = str_replace("(n)", "<img src='../images/smileys/thumbs_down.gif' width='19' height='19' align='absmiddle' />", $body);

    return $body;
}