/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validUrl(url){
    reg=/^(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?/;
    return reg.test(url);
}