function switch_up(id, level,imgname,type)
{
    if(type==1)
    {
        var poziom=level;
        var obraz=imgname + poziom + ".png";
        document.getElementById(id).innerHTML='<img src="frontend/images/'+obraz+'"alt="" width="920" height="800"/>'	
    }
    else if(type==2)
    {
        var poziom=level;
        var obraz=imgname + poziom + ".png";
        document.getElementById(id).innerHTML='<img src="frontend/images/'+obraz+'"alt="" width="150" height="130"/>'	
    }
}
                                    