var flashReady=false;
var flashInitalized=false;
var auctions=[];

function updateAuction(id,auctionprice,time){
    var ImageGallery = getSWF('ImageGallery');
    if(ImageGallery && ImageGallery.updateAuction){

        if(auctions.has(id)){
            ImageGallery.updateAuction(id,auctionprice,time);
        }
    }
}
var Browser = {
  Version: function() {
    var version = 999; // we assume a sane browser
    if (navigator.appVersion.indexOf("MSIE") != -1)
      // bah, IE again, lets downgrade version number
      version = parseFloat(navigator.appVersion.split("MSIE")[1]);
    return version;
  }
}

function getSWF(movieName)
{
  /*  if (navigator.appName.indexOf("Microsoft"))
    {

      if(Browser.Version() >= 9){
       return document[movieName];
      }else{
        return window[movieName];
      }
    }
    else
    {*/
        return document[movieName];
   // }
}

function array_has(val)
{
    var i;
    for(i = 0; i < this.length; i++)
    {
        if(this[i] == val)
        {
            return true;
        }
    }
    return false;
}
Array.prototype.has = array_has;