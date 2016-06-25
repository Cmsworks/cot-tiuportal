<!-- BEGIN: MAIN -->
      <div class="page-header">
        <h1>{PHP.L.tags_Search_tags}</h1>
      </div>

      <form action="{TAGS_ACTION}" method="post" role="form">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input class="form-control" type="text" name="t" value="{TAGS_QUERY}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" name="order">
                <option value="">{PHP.L.tags_Orderby}</option>
                <option value="">--</option>
                {TAGS_ORDER}
              </select>
            </div>
          </div>
          <input class="btn btn-primary" type="submit" value="{PHP.L.Search}">
        </div>
      </form>

      <!-- BEGIN: TAGS_CLOUD -->
      <h3>{PHP.L.tags_All}</h3>
      {TAGS_CLOUD_BODY}
      <!-- END: TAGS_CLOUD -->
      <!-- BEGIN: TAGS_RESULT -->
      <h3>{TAGS_RESULT_TITLE}</h3>
      <ol>
        <!-- BEGIN: TAGS_RESULT_ROW -->
        <li>
          <strong>
            <a href="{TAGS_RESULT_ROW_URL}">{TAGS_RESULT_ROW_TITLE}</a>
          </strong>
          <br>
          <small>
            <strong>{PHP.L.Sections}:</strong> {TAGS_RESULT_ROW_PATH}
            <br>
            <strong>{PHP.L.Tags}:</strong> {TAGS_RESULT_ROW_TAGS}
          </small>
          <!-- IF {TAGS_RESULT_ROW_TEXT_CUT} -->
          <p>{TAGS_RESULT_ROW_TEXT_CUT}</p>
          <!-- ENDIF -->
        </li>
        <!-- END: TAGS_RESULT_ROW -->
      </ol>
      <!-- BEGIN: TAGS_RESULT_NONE -->
      <div class="alert alert-warning">
        {PHP.L.Noitemsfound}
      </div>
      <!-- END: TAGS_RESULT_NONE -->
      <!-- END: TAGS_RESULT -->
      <!-- IF {TAGS_PAGNAV} -->
      <ul class="pagination">{TAGS_PAGEPREV}{TAGS_PAGNAV}{TAGS_PAGENEXT}</ul>
      <!-- ENDIF -->

      <div class="alert alert-info">
        {TAGS_HINT}
      </div>
<!-- END: MAIN -->
