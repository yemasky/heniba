<%section name=i loop=$hotel_list%>
<%section name=j loop=$hotel_list[i].Hotel%>
<tr>
  <td><%$hotel_list[i].Hotel[j].hotelId%></td>
  <td width="175">
    <a href="index.php?model=<%$model%>&action=product&supplier_code=tourico&id=<%$hotel_list[i].Hotel[j].hotelId%>&<%$search_data_url%>" target="_blank">
      <img src="<%$hotel_list[i].Hotel[j].thumb%>" />
    </a>
  </td><td>
    酒店：<%$hotel_list[i].Hotel[j].name%> 星级：<%$hotel_list[i].Hotel[j].starsLevel%>星 <br>
    地址：<%$hotel_list[i].Hotel[j].Location[0].address%><br>
    描述：<%$hotel_list[i].Hotel[j].desc%><br>
    <%section name=k loop=$hotel_list[i].Hotel[j].RoomTypes[0].RoomType%>
    床型：<%$hotel_list[i].Hotel[j].RoomTypes[0].RoomType[k].name%> ,
    <%/section%>

  </td>
  <td><a href="#"><%$hotel_list[i].Hotel[j].Location[0].countryCode%>:(原价)<%$hotel_list[i].Hotel[j].minAverPublishPrice%> (售价)<%$hotel_list[i].Hotel[j].minAverPublishPrice%></a></td>
  <td><span class="am-badge am-badge-success">+20</span></td>
  <td>
    <a href="index.php?model=<%$model%>&action=product&supplier_code=tourico&id=<%$hotel_list[i].Hotel[j].hotelId%>&<%$search_data_url%>" target="_blank">
      <div class="am-dropdown" data-am-dropdown>
        <button class="am-btn am-btn-warning am-round" type="button"><i class="am-icon-shopping-cart"></i>　预 定</button>
      </div>
    </a>
  </td>
</tr>
<%/section%>
<%/section%>