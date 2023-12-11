<?php

function pagenationBar($current_page, $url, $pagecount)
{
  echo "<nav aria-label='Page navigation example'>
      <ul class='pagination'><li class='page-item" . ($current_page == 1 ? " disabled" : "") . "'>";
  if ($current_page > 0) {
    echo "<a class='page-link' href='" . $url . "page=" . ($current_page - 1) . "'>Previous</a>";
  } else {
    echo "<span class='page-link'>Previous</span>";
  }

  echo "</li>";


  for ($i = 1; $i <= $pagecount; $i++) {
    echo "
      <li class='page-item" . ($current_page == $i ? " active" : "") . "'><a class='page-link' href='" . $url . "page=" . $i . "'>" . $i . "</a></li>";
  }

  echo "<li class='page-item" . ($current_page == $pagecount ? " disabled" : "") . "'>";
  if ($current_page < $pagecount) {
    echo "<a class='page-link' href='" . $url . "page=" . ($current_page + 1) . "'>Next</a>";
  } else {
    echo "<span class='page-link'>Next</span>";
  }

  echo "</li></ul>
      </nav>";
}

?>