<?php
class channel_ajax
{
    public $m_channel;
    public function __construct()
    {
        if(file_exists('../model/m_channel.php'))
        {
            include '../model/m_channel.php';
        }

        $this->m_channel = new m_channel();
        // BƯỚC 1: LẤY THÔNG TIN
        $id = isset($_POST['channelId']) ? trim($_POST['channelId']) : '';
        if(isset($_POST["type"]))
        {
            $type = $_POST['type'];
            switch($type)
            {
                case "init":
                    $strHtml = '';
                    if($id != ''){
                        $TotalVideoUpload = $this->m_channel->GetTotalVideoUploadByChannelID($id);
                        $strHtml = '<input type="hidden" name="channelID" value="'.$id.'"><div class="form-group">
							  <div class="col-sm-12">
								  <label>Số video upload trong 1 ngày</label>
								  <select class="form-control m-bot15" id="TotalVideoUpload" name="TotalVideoUpload">
									<option value="0" disabled selected hidden>Chọn số video upload trong 1 ngày..</option>';
                        for($i = 1; $i<=5; $i++)
                        {
                            $strHtml .= '<option value="'.$i.'" '.($TotalVideoUpload['TotalVideoUpload']== $i ? 'selected' : '').'>'.$i.'</option>';
                        }
                        $strHtml .= '</select></div></div>';
                        $schedules = $this->m_channel->GetSchedulePublicByConfigID($id);
						$strHtml .='<div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Số video publish trong ngày</label>
                                            <select class="form-control m-bot15" id="TotalVideoPublish" onchange="ChangeTotalVideoPublic('.trim($id).')" name="TotalVideoPublish">
                                                <option value="0" '.(count($schedules) == 0? 'selected': '').'>Chọn số video puhlish trong ngày</option>
                                                <option value="1" '.(count($schedules) == 1? 'selected': '').'>1</option>
                                                <option value="2" '.(count($schedules) == 2? 'selected': '').'>2</option>
                                                <option value="3" '.(count($schedules) == 3? 'selected': '').'>3</option>
                                                <option value="4" '.(count($schedules) == 4? 'selected': '').'>4</option>
                                                <option value="5" '.(count($schedules) == 5? 'selected': '').'>5</option>
                                            </select>
                                        </div>
                                    </div><div id="configTimePublic">';
                        if(count($schedules) > 0){
                            for($j = 0; $j< count($schedules); $j++){
                                $strHtml .='<div class="form-group" >
								<div class="col-sm-4">
								<label>Giờ:</label>
								<select class="form-control m-bot15" id="Hours" name="Hours[]">
								<option value="" disabled selected hidden>Giờ upload...</option>';
								for($i = 0; $i<=23; $i++)
								{
									if($i < 10){
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Hours'] == $i ? 'selected': '') : '').'>0'.$i.'</option>';
									}else{
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Hours'] == $i ? 'selected': '') : '').'>'.$i.'</option>';
									}
								}
								$strHtml .='</select></div><div class="col-sm-4">
								<label>Phút:</label>
								<select class="form-control m-bot15" id="Minutes" name="Minutes[]">
								<option value="" disabled selected hidden>Phút upload...</option>';
								for($i = 0; $i<=59; $i+=15)
								{									
									if($i < 10){
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Minutes'] == $i ? 'selected': '') : '').'>0'.$i.'</option>';
									}else{
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Minutes'] == $i ? 'selected': '') : '').'>'.$i.'</option>';
									}
								}
								$strHtml .='</select> </div><div class="col-sm-4">
											<label>TimeZone:</label>
											 <select class="form-control m-bot15" id="Zone" name="Zone[]">
												<option value="0" disabled selected hidden>TimeZone...</option>											
												<option value="-12"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-12' ? 'selected' : '').'>-12</option>
												<option value="-11"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-11' ? 'selected' : '').'>-11</option>
												<option value="-10"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-10' ? 'selected' : '').'>-10</option>
												<option value="-9"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-9' ? 'selected' : '').'>-9</option>
												<option value="-8"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-8' ? 'selected' : '').'>-8</option>
												<option value="-7"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-7' ? 'selected' : '').'>-7</option>
												<option value="-6"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-6' ? 'selected' : '').'>-6</option>
												<option value="-5"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-5' ? 'selected' : '').'>-5</option>
												<option value="-4"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-4' ? 'selected' : '').'>-4</option>
												<option value="-3"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-3' ? 'selected' : '').'>-3</option>
												<option value="-2"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-2' ? 'selected' : '').'>-2</option>
												<option value="-1"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-1' ? 'selected' : '').'>-1</option>
												<option value="0"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='0' ? 'selected' : '').'>0</option>
												<option value="+1"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+1' ? 'selected' : '').'>+1</option>
												<option value="+2"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+2' ? 'selected' : '').'>+2</option>
												<option value="+3"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+3' ? 'selected' : '').'>+3</option>
												<option value="+4"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+4' ? 'selected' : '').'>+4</option>
												<option value="+5"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+5' ? 'selected' : '').'>+5</option>
												<option value="+6"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+6' ? 'selected' : '').'>+6</option>
												<option value="+7"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+7' ? 'selected' : (isset($schedules[$j]) ? '' : 'selected')).'>+7</option>
												<option value="+8"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+8' ? 'selected' : '').'>+8</option>
												<option value="+9"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+9' ? 'selected' : '').'>+9</option>
												<option value="+10"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+10' ? 'selected' : '').'>+10</option>
												<option value="+11"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+11' ? 'selected' : '').'>+11</option>
												<option value="+12"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+12' ? 'selected' : '').'>+12</option>
											 </select>
										 </div>
									 </div>';
                            }
							$strHtml .='<div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Video sẽ publish sau:</label>
                                            <select class="form-control m-bot15" id="" name="AfterDays">
                                                <option value="0">khi upload xong</option>
                                                <option value="1" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 1 ? 'selected': '') : '').'>1 Ngày</option>
                                                <option value="2" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 2 ? 'selected': '') : '').'>2 Ngày</option>
                                                <option value="3" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 3 ? 'selected': '') : '').'>3 Ngày</option>
                                                <option value="4" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 4 ? 'selected': '') : '').'>4 Ngày</option>
                                                <option value="5" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 5 ? 'selected': '') : '').'>5 Ngày</option>
                                            </select>
                                        </div>
                                    </div></div>';
                        }
                    }
                    break;
                case "change":
                    $TotalVideoPublic = isset($_POST['TotalVideo']) ? trim($_POST['TotalVideo']) : '';
					$id = isset($_POST['channelId']) ? trim($_POST['channelId']) : '';
					$schedules = $this->m_channel->GetSchedulePublicByConfigID($id);
                    $strHtml = '';
                    if($id != ''){
                        if((int)$TotalVideoPublic > 0){
                            for($j = 0; $j< (int)$TotalVideoPublic; $j++){
                                $strHtml .='<div class="form-group" >
								<div class="col-sm-4">
								<label>Giờ:</label>
								<select class="form-control m-bot15" id="Hours" name="Hours[]">
								<option value="" disabled selected hidden>Giờ upload...</option>';
								for($i = 0; $i<=23; $i++)
								{
									if($i < 10){
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Hours'] == $i ? 'selected': '') : '').'>0'.$i.'</option>';
									}else{
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Hours'] == $i ? 'selected': '') : '').'>'.$i.'</option>';
									}
								}
								$strHtml .='</select></div><div class="col-sm-4">
								<label>Phút:</label>
								<select class="form-control m-bot15" id="Minutes" name="Minutes[]">
								<option value="" disabled selected hidden>Phút upload...</option>';
								for($i = 0; $i<=59; $i+= 15)
								{
									if($i < 10){
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Minutes'] == $i ? 'selected': '') : '').'>0'.$i.'</option>';
									}else{
										$strHtml .='<option value="'.$i.'" '.(isset($schedules[$j]) ? ($schedules[$j]['Minutes'] == $i ? 'selected': '') : '').'>'.$i.'</option>';
									}
								}
								$strHtml .='</select> </div><div class="col-sm-4">
											<label>TimeZone:</label>
											 <select class="form-control m-bot15" id="Zone" name="Zone[]">
												<option value="" disabled selected hidden>TimeZone...</option>											
												<option value="-12"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-12' ? 'selected' : '').'>-12</option>
												<option value="-11"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-11' ? 'selected' : '').'>-11</option>
												<option value="-10"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-10' ? 'selected' : '').'>-10</option>
												<option value="-9"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-9' ? 'selected' : '').'>-9</option>
												<option value="-8"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-8' ? 'selected' : '').'>-8</option>
												<option value="-7"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-7' ? 'selected' : '').'>-7</option>
												<option value="-6"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-6' ? 'selected' : '').'>-6</option>
												<option value="-5"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-5' ? 'selected' : '').'>-5</option>
												<option value="-4"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-4' ? 'selected' : '').'>-4</option>
												<option value="-3"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-3' ? 'selected' : '').'>-3</option>
												<option value="-2"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-2' ? 'selected' : '').'>-2</option>
												<option value="-1"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='-1' ? 'selected' : '').'>-1</option>
												<option value="0"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='0' ? 'selected' : '').'>0</option>
												<option value="+1"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+1' ? 'selected' : '').'>+1</option>
												<option value="+2"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+2' ? 'selected' : '').'>+2</option>
												<option value="+3"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+3' ? 'selected' : '').'>+3</option>
												<option value="+4"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+4' ? 'selected' : '').'>+4</option>
												<option value="+5"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+5' ? 'selected' : '').'>+5</option>
												<option value="+6"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+6' ? 'selected' : '').'>+6</option>
												<option value="+7"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+7' ? 'selected' : (isset($schedules[$j]) ? '' : 'selected')).'>+7</option>
												<option value="+8"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+8' ? 'selected' : '').'>+8</option>
												<option value="+9"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+9' ? 'selected' : '').'>+9</option>
												<option value="+10"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+10' ? 'selected' : '').'>+10</option>
												<option value="+11"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+11' ? 'selected' : '').'>+11</option>
												<option value="+12"'.(isset($schedules[$j]) && $schedules[$j]['TimeZone']=='+12' ? 'selected' : '').'>+12</option>
											 </select>
										 </div>
									 </div>';
                            }
							$strHtml .='<div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Video sẽ publish sau:</label>
                                            <select class="form-control m-bot15" id="" name="AfterDays">
                                                <option value="0">khi upload xong</option>
                                                <option value="1" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 1 ? 'selected': '') : '').'>1 Ngày</option>
                                                <option value="2" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 2 ? 'selected': '') : '').'>2 Ngày</option>
                                                <option value="3" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 3 ? 'selected': '') : '').'>3 Ngày</option>
                                                <option value="4" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 4 ? 'selected': '') : '').'>4 Ngày</option>
                                                <option value="5" '.(isset($schedules[0]) ? ($schedules[0]['AfterDays'] == 5 ? 'selected': '') : '').'>5 Ngày</option>
                                            </select>
                                        </div>
                                    </div></div>';
                    }
				}
				break;
            }
        }
        echo $strHtml;
    }
}
$channel_ajax = new channel_ajax();
?>
