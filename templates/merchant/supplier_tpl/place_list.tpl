<div data-am-widget="list_news" class="am-list-news am-list-news-default am-scrollable-vertical am-margin-right-0">
  <div class="am-list-news-bd">
    <ul class="am-list">
      <%section name=place loop=$arrayPlace%>
      <li class="am-g am-list-item-dated">
        <a href="##" class="am-list-item-hd "><%$arrayPlace[place].c_name_cn%></a>
        <span class="am-list-date"><%$arrayPlace[place].c_name%></span>
      </li>
      <%/section%>
      <li>　　　　　　　　　　　　　　　　　　　　　　　　　　</li>
    </ul>
  </div>
</div>