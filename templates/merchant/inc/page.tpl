<ul class="am-pagination am-fr admin-content-pagination">
    <%section name=i loop=$page%>
    <li<%if $pn==$page[i]%> class="am-active"<%elseif $page[i]==''%> class="am-disabled"<%/if%>><a href="index.php?model=<%$model%>&pn=<%$page[i]%>"><%if $smarty.section.i.first%>上<%$show_pages%>页<%elseif $smarty.section.i.last%>下<%$show_pages%>页<%else%><%$page[i]%><%/if%></a></li>
    <%/section%>
    <!--li class="am-disabled"><a href="#">&laquo;</a></li>
    <li class="am-active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li-->
</ul>