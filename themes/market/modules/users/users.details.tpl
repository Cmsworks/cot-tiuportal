<!-- BEGIN: MAIN -->
      <div class="page-header">
        <h1>
          {USERS_DETAILS_NAME}
          <!-- BEGIN: USERS_DETAILS_ADMIN --> &nbsp; [ {USERS_DETAILS_ADMIN_EDIT} ]<!-- END: USERS_DETAILS_ADMIN -->
          <!-- IF {USERS_DETAILS_ONLINE} == 1 -->
          <span class="pagelabel label label-success pull-right">{PHP.L.Online}</span>
          <!-- ELSE -->
          <span class="pagelabel label label-default pull-right">{PHP.L.Offline}</span>
          <!-- ENDIF -->
        </h1>
      </div>

      <div class="row">
        <div class="col-md-2">
          <center>{USERS_DETAILS_AVATAR}</center>
        </div>
        <div class="col-md-10">
            <div class="tabbable">
              <ul class="nav nav-tabs">
                <li<!-- IF !{PHP.tab} --> class="active"<!-- ENDIF -->><a href="{USERS_DETAILS_DETAILSLINK}#tab_info" data-toggle="tab">{PHP.L.Main}</a></li>
                <!-- IF {PHP.cot_modules.market} -->
                <li<!-- IF {PHP.tab} == 'market' --> class="active"<!-- ENDIF -->><a href="{USERS_DETAILS_MARKET_URL}#tab_market" data-toggle="tab">{PHP.L.market} {USERS_DETAILS_MARKET_COUNT}</a></li>
                <!-- ENDIF -->
              </ul>
            </div>
            <div class="tab-content">            
              <div class="tab-pane<!-- IF !{PHP.tab} --> active<!-- ENDIF -->" id="tab_info">
                <table class="cells table table-bordered table-striped">
                  <!-- IF {PHP.cot_modules.pm} -->
                  <tr>
                    <td>{PHP.L.users_sendpm}:</td>
                    <td>{USERS_DETAILS_PM}</td>
                  </tr>
                  <!-- ENDIF -->
                  <tr>
                    <td width="220">{PHP.L.Country}:</td>
                    <td>{USERS_DETAILS_COUNTRYFLAG} {USERS_DETAILS_COUNTRY}</td>
                  </tr>
                  <tr>
                    <td width="170">{PHP.L.Location}:</td>
                    <td>{USERS_DETAILS_REGION} {USERS_DETAILS_CITY}</td>
                  </tr>
                  <tr>
                    <td>{PHP.L.Timezone}:</td>
                    <td>{USERS_DETAILS_TIMEZONE}</td>
                  </tr>
                  <tr>
                    <td>{PHP.L.Birthdate}:</td>
                    <td>{USERS_DETAILS_BIRTHDATE}</td>
                  </tr>
                  <tr>
                    <td>{PHP.L.Age}:</td>
                    <td>{USERS_DETAILS_AGE}</td>
                  </tr>
                  <tr>
                    <td>{PHP.L.Gender}:</td>
                    <td>{USERS_DETAILS_GENDER}</td>
                  </tr>
                  <tr>
                    <td>{PHP.L.Registered}:</td>
                    <td>{USERS_DETAILS_REGDATE}</td>
                  </tr>
                </table>      
                  <!-- IF {USERS_DETAILS_TEXT} -->
                  <h4>{PHP.L.Signature}:</h4>
                  <blockquote>
                    <p>{USERS_DETAILS_TEXT}</p>
                    <small>{USERS_DETAILS_NICKNAME}</small>
                  </blockquote>
                  <!-- ENDIF -->
              </div>
              
              <div class="tab-pane<!-- IF {PHP.tab} == 'market' --> active<!-- ENDIF -->" id="tab_market">
                {MARKET}
              </div>
            </div>
        </div>
      </div>
<!-- END: MAIN -->
