function browser(params){
	if(params==null)params={};
	if(params.contentsDisplay==null)params.contentsDisplay=document.body;
	if(params.currentPath==null)params.currentPath="";
	if(params.filter==null)params.filter="";
	if(params.loadingMessage==null)params.loadingMessage="Loading...";
	if(params.data==null)params.data="";

	var search=function(){
		if(params.pathDisplay!=null)params.pathDisplay.innerHTML=params.loadingMessage;
		
		var f=typeof(params.filter)=="object"?params.filter.value:params.filter;
		var a=new Ajax();
		with (a){
			Method="POST";
			URL=siteurl + "backendadmin/DESIGN/search_dir.php";
			Data="path="+params.currentPath+"&filter="+f+"&data="+params.data;
			ResponseFormat="json";
			ResponseHandler=showFiles;
			Send();
		}
	}
	
	if(params.refreshButton!=null)params.refreshButton.onclick=search;

	var showFiles=function(res){
		if(params.pathDisplay!=null){
			var p=res.currentPath;
			p=p.replace(/^(\.\.\/|\.\/|\.)*/g,"");
			
			if(params.pathDisplay!=null){
				params.pathDisplay.title=p;
				if(params.pathMaxDisplay!=null){
					if(p.length>params.pathMaxDisplay)p="..."+p.substr(p.length-params.pathMaxDisplay,params.pathMaxDisplay);
				}
				params.pathDisplay.innerHTML="[Rt:\] "+p;
			}
		}
		
		params.contentsDisplay.innerHTML="";
		var oddeven="odd";
		txt = '<table>';
		$(params.contentsDisplay).append(txt);
		for (i=0;i<res.contents.length;i++){
			var f=res.contents[i];
			/*
			var el=document.createElement("p");
			with(el){
				setAttribute('id', i + '_file');
				setAttribute("title",f.fName);
				setAttribute("fPath",f.fPath);
				setAttribute("fType",f.fType);
				className=oddeven + " item ft_"+f.fType;
				innerHTML=f.fName;
			}
			params.contentsDisplay.appendChild(el);*/
			
			txt = '<tr><td id="file_' + i + '" class="' + oddeven + " item ft_"+f.fType + ' list"><span style="margin-left:25px;display:inline;">' + f.fName;
			txt += '</span><table style="display:inline;position:absolute;left:210px;"><tr>';
			txt += '<td style="width:110px;"><span style="width:110px;">' + f.fType + '</span></td>';
			txt += '<td style="width:110px;"><span style="width:110px;">' + f.fWidth + 'x' + f.fHeight + '</span></td>';
			txt += '<td style="width:110px;"><span style="width:110px;">' + f.fTime + '</span></td>';
			txt += '<td style="width:110px;" onclick="javascript: deleteBanner(\'' + f.fName + '\');"><span style="width:110px;">Del.</span></td>';
			//txt += '<td style="float:left;" class="uploader" id="file_' + i + '_upload">Edit</td>';
			txt += '</tr></table></td></tr>';
			
			
			
			$(params.contentsDisplay).append(txt);
			
			
			oddeven=(oddeven=="odd")?"even":"odd";
			$('#file_' + i ).qtip({content:{ text: '<img src="' + siteurl + '/include/addons/slider/' + template + '/img/'+f.fName+'" style="width:' + f.fWidth / 2 + 'px;height:auto;" />'}, 
			
			      show:{ready:false, solo:true},
			      
			      
			      position: {
				  target:$('#file_' + i), my: 'bottom left', at : 'top left'
			      
			      }, style: { width: f.fWidth / 2 , height: f.fHeight / 2 }
			      });
		}
		txt = '</table>';
		$(params.contentsDisplay).append(txt);
	}

	var selectItem=function(){
		var ftype=this.getAttribute("fType");
		var fpath=this.getAttribute("fPath");
		var ftitle=this.getAttribute("title");

		if(params.onSelect!=null)params.openFolderOnSelect=params.onSelect({"type":ftype,"path":fpath,"title":ftitle,"item":this},params);
		if(params.openFolderOnSelect==null)params.openFolderOnSelect=true;
		
		if(ftype=="folder" && params.openFolderOnSelect){
			params.currentPath=fpath;
			search();
		}
	}

	search();
}