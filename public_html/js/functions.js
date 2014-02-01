function showHideNewListInput(theForm){
   if(theForm.new_old[theForm.new_old.selectedIndex].value == 'old'){
        theForm.new_list_name.style.display='none'; 
        theForm.list.style.display=''; 
   }
   else{
        theForm.new_list_name.style.display=''; 
        theForm.list.style.display='none'; 
   }
}
