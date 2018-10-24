<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <input type="hidden" name="IDConfig" value="<?php if ($videoID != ''){ echo $videoID;}?>">
            <header class="panel-heading">
				<script language="JavaScript">
					function CheckForm(form_id)
					{
						var cansubmit = true;
						switch(form_id)
						{
							case 1:
								var data = document.getElementById("AddTitle");
								if(data.value.length > 100)
								{
									//Hiden submit of buttom
									cansubmit = false;
									alert('Tiêu đề dài quá 100 ký tự!');
								}else
									cansubmit = true;
							break;
							case 2:
								var data = document.getElementById("AddDes");
								if(data.value.length > 5000)
								{
									//Hiden submit of buttom
									cansubmit = false;
									alert('Mô tả dài quá 5000 ký tự!');
								}else
									cansubmit = true;
							break;
							case 3:
							//Count command
								var data = document.getElementById("AddTag");
								var count_comman = data.value.split(",").length-1;
								if(data.value.length+count_comman > 500)
								{
									//Hiden submit of buttom
									cansubmit = false;
									alert('Thẻ tag dài quá 500 ký tự!');
								}else
									cansubmit = true;
							break;
							default:
								cansubmit = true;
							break;
						}
						
						document.getElementById('btn_update_video').disabled = !cansubmit;
						return cansubmit;
					}
					function CheckFormBeforSubmit()
					{
						if(CheckForm(1) == false)
							return;
						if(CheckForm(2) == false)
							return;
						if(CheckForm(3) == false)
							return;
					}
                </script>
                <div> 
                    <iframe width="500" height="300" src="https://www.youtube.com/embed/<?php echo $videoID?>" frameborder="0" allow="autoplay; encrypted-media"></iframe>

                </div>
				
			</header><br> <br>
            <body>
				<div class="col-sm-12">
					<label>Thời gian publish:&nbsp &nbsp </label>
					<?php 
						if ($videoID != '')
						{
							date_default_timezone_set('Asia/Ho_Chi_Minh');
							$dt = $response['items'][0]['snippet']['publishedAt'];
							$theDateFormattedMyWay = date("F j, Y - H:i:s", strtotime($dt));
							echo $theDateFormattedMyWay;
						}
					?>
					<br>
                    <label>View: &nbsp </label><?php if ($videoID != '') echo $response['items'][0]['statistics']['viewCount'];?>
                    <label>&nbsp &nbsp &nbsp &nbsp Comment: &nbsp </label> <?php if ($videoID != '') echo $response['items'][0]['statistics']['commentCount'];?>
                    <label>&nbsp &nbsp &nbsp &nbsp Like: &nbsp </label> <?php if ($videoID != '') echo $response['items'][0]['statistics']['likeCount'];?>
                    <label>&nbsp &nbsp &nbsp &nbsp Dislike: &nbsp </label> <?php if ($videoID != '') echo $response['items'][0]['statistics']['dislikeCount'];?>
					<label>&nbsp &nbsp &nbsp &nbsp Thời lượng: &nbsp </label> <?php if ($videoID != '') echo $videoDuration;?>
					<br>
					<label>Bản quyền: &nbsp </label> <?php if ($videoID != '') echo $video_restric ;?>
					<br>
                </div>
				<form action="<?php echo BASE_PATH;?>admin/controller/c_video_manager.php?controller=video_manager&action=update_video&videoID=<?php echo $videoID;?>&channelID=<?php echo $channel['ChannelID']?>" method="post">
                <div class="col-sm-12">
                    <label>Tên kênh</label>
                    <input id="ChannelName" disabled name="ChannelName" class="form-control" type="text" value="<?php echo $channel['ChannelName'];?>">
                </div>

                <div class="col-sm-12">
                    <label>Tiêu đề</label>
                    <div id="box_add_all_des" class="col-lg-12">
                        <input type="text" name="AddTitle"  id="AddTitle" onKeyup="CheckForm(1);" value="<?php if ($videoID != '') echo $response['items'][0]['snippet']['title'];?>" class="form-control tat" rows="8" >
                        <br>
                    </div>
                </div> <br>
                <div class="col-sm-12">
                    <label>Mô tả </label>
                    <div id="box_add_all_des" class="col-lg-12">
                        <textarea type="text" name="AddDes" class="form-control tat" id="AddDes" onKeyup="CheckForm(2);" rows="8" ><?php if ($videoID != '') echo $response['items'][0]['snippet']['description'];?></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label> Tags </label>
                    <div id="box_add_all_tag"  class="col-lg-12">
                        <textarea type="text" name="AddTag" class="form-control tat" id="AddTag" onKeyup="CheckForm(3);" rows="8" ><?php if(!empty($response['items'][0]['snippet']['tags']) ) {foreach ($response['items'][0]['snippet']['tags'] as $tag){echo $tag.",";}};?></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label >Danh mục</label>
                    <select class="form-control input_select col-lg-12" id="CategoryAdd" name="CategoryAdd"  >
                        <option value="1">Mặc Định</option>
                        <option value="1" <?php if($response['items'][0]['snippet']['categoryId']=="1") echo "selected= 1";?>>Film Animation </option>
                        <option value="29" <?php if($response['items'][0]['snippet']['categoryId']=="29") echo "selected= 1";?>>Nonprofits Activism </option>
                        <option value="28" <?php if($response['items'][0]['snippet']['categoryId']=="28") echo "selected= 1";?>>Science Technology </option>
                        <option value="27" <?php if($response['items'][0]['snippet']['categoryId']=="27") echo "selected= 1";?>>Education </option>
                        <option value="26" <?php if($response['items'][0]['snippet']['categoryId']=="26") echo "selected= 1";?>>Howto Style </option>
                        <option value="25" <?php if($response['items'][0]['snippet']['categoryId']=="25") echo "selected= 1";?>>News Politics </option>
                        <option value="24" <?php if($response['items'][0]['snippet']['categoryId']=="24") echo "selected= 1";?>>Entertainment </option>
                        <option value="23" <?php if($response['items'][0]['snippet']['categoryId']=="23") echo "selected= 1";?>>Comedy </option>
                        <option value="22" <?php if($response['items'][0]['snippet']['categoryId']=="22") echo "selected= 1";?>>People Blogs </option>
                        <option value="20" <?php if($response['items'][0]['snippet']['categoryId']=="20") echo "selected= 1";?>>Gaming </option>
                        <option value="19" <?php if($response['items'][0]['snippet']['categoryId']=="19") echo "selected= 1";?>>Travel Events </option>
                        <option value="15" <?php if($response['items'][0]['snippet']['categoryId']=="15") echo "selected= 1";?>>Pets Animals </option>
                        <option value="10" <?php if($response['items'][0]['snippet']['categoryId']=="10") echo "selected= 1";?>>Music </option>
                        <option value="2"  <?php if($response['items'][0]['snippet']['categoryId']=="2") echo "selected= 1";?>>Autos Vehicles </option>
                        <option value="17" <?php if($response['items'][0]['snippet']['categoryId']=="17") echo "selected= 1" ;?>>Sports </option>
                    </select>
                    <br>
                </div>
                <div class="col-sm-12">
                    <label >Ngôn ngữ</label>
                    <select class="form-control input_select col-lg-12" id="LanguageAdd" name="LanguageAdd"  >
                        <option value="" >Chọn ngôn ngữ  </option>
                        <option value="ab" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ab")echo "selected = 1";?> >Abkhazian</option>
                        <option value="aa" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="aa")echo "selected = 1";?>>Afar</option>
                        <option value="af" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="af")echo "selected = 1";?>>Afrikaans</option>
                        <option value="ak" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ak")echo "selected = 1";?>>Akan</option>
                        <option value="sq" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sq")echo "selected = 1";?>>Albanian</option>
                        <option value="am" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="am")echo "selected = 1";?>>Amharic</option>
                        <option value="ar" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ar")echo "selected = 1";?>>Arabic</option>
                        <option value="an" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="an")echo "selected = 1";?>>Aragonese</option>
                        <option value="hy" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="hy")echo "selected = 1";?>>Armenian</option>
                        <option value="as" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="as")echo "selected = 1";?>>Assamese</option>
                        <option value="av" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="av")echo "selected = 1";?>>Avaric</option>
                        <option value="ae" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ae")echo "selected = 1";?>>Avestan</option>
                        <option value="ay" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ay")echo "selected = 1";?>>Aymara</option>
                        <option value="az" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="az")echo "selected = 1";?>>Azerbaijani</option>
                        <option value="bm" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="bm")echo "selected = 1";?>>Bambara</option>
                        <option value="ba" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ba")echo "selected = 1";?>>Bashkir</option>
                        <option value="eu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="eu")echo "selected = 1";?>>Basque</option>
                        <option value="be" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="be")echo "selected = 1";?>>Belarusian</option>
                        <option value="bn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="bn")echo "selected = 1";?>>Bengali</option>
                        <option value="bh" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="bh")echo "selected = 1";?>>Bihari languages</option>
                        <option value="bi" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="bi")echo "selected = 1";?>>Bislama</option>
                        <option value="bs" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="bs")echo "selected = 1";?>>Bosnian</option>
                        <option value="br" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="br")echo "selected = 1";?>>Breton</option>
                        <option value="bg" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="bg")echo "selected = 1";?>>Bulgarian</option>
                        <option value="my" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="my")echo "selected = 1";?>>Burmese</option>
                        <option value="ca" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ca")echo "selected = 1";?>>Catalan, Valencian</option>
                        <option value="ch" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ch")echo "selected = 1";?>>Chamorro</option>
                        <option value="ce" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ce")echo "selected = 1";?>>Chechen</option>
                        <option value="ny" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ny")echo "selected = 1";?>>Chichewa, Chewa, Nyanja</option>
                        <option value="zh" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="zh")echo "selected = 1";?>>Chinese</option>
                        <option value="cv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="cv")echo "selected = 1";?>>Chuvash</option>
                        <option value="kw" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kw")echo "selected = 1";?>>Cornish</option>
                        <option value="co" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="co")echo "selected = 1";?>>Corsican</option>
                        <option value="cr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="cr")echo "selected = 1";?>>Cree</option>
                        <option value="hr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="hr")echo "selected = 1";?>>Croatian</option>
                        <option value="cs" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="cs")echo "selected = 1";?>>Czech</option>
                        <option value="da" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="da")echo "selected = 1";?>>Danish</option>
                        <option value="dv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="dv")echo "selected = 1";?>>Divehi, Dhivehi, Maldivian</option>
                        <option value="nl" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="nl")echo "selected = 1";?>>Dutch, Flemish</option>
                        <option value="dz" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="dz")echo "selected = 1";?>>Dzongkha</option>
                        <option value="en-US" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="en-US")echo "selected = 1";?>>English(US)</option>
                        <option value="eo" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="eo")echo "selected = 1";?>>Esperanto</option>
                        <option value="et" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="et")echo "selected = 1";?>>Estonian</option>
                        <option value="ee" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ee")echo "selected = 1";?>>Ewe</option>
                        <option value="fo" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="fo")echo "selected = 1";?>>Faroese</option>
                        <option value="fj" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="fj")echo "selected = 1";?>>Fijian</option>
                        <option value="fl" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="fl")echo "selected = 1";?>>Filipino</option>
                        <option value="fi" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="fi")echo "selected = 1";?>>Finnish</option>
                        <option value="fr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="fr")echo "selected = 1";?>>French</option>
                        <option value="ff" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ff")echo "selected = 1";?>>Fulah</option>
                        <option value="gl" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="gl")echo "selected = 1";?>>Galician</option>
                        <option value="ka" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ka")echo "selected = 1";?>>Georgian</option>
                        <option value="de" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="de")echo "selected = 1";?>>German</option>
                        <option value="el" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="el")echo "selected = 1";?>>Greek (modern)</option>
                        <option value="gn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="gn")echo "selected = 1";?>>Guaraní</option>
                        <option value="gu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="gu")echo "selected = 1";?>>Gujarati</option>
                        <option value="ht" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ht")echo "selected = 1";?>>Haitian, Haitian Creole</option>
                        <option value="ha" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ha")echo "selected = 1";?>>Hausa</option>
                        <option value="he" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="he")echo "selected = 1";?>>Hebrew (modern)</option>
                        <option value="hz" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="hz")echo "selected = 1";?>>Herero</option>
                        <option value="hi" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="hi")echo "selected = 1";?>>Hindi</option>
                        <option value="ho" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ho")echo "selected = 1";?>>Hiri Motu</option>
                        <option value="hu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="hu")echo "selected = 1";?>>Hungarian</option>
                        <option value="ia" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ia")echo "selected = 1";?>>Interlingua</option>
                        <option value="id" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="id")echo "selected = 1";?>>Indonesian</option>
                        <option value="ie" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ie")echo "selected = 1";?>>Interlingue</option>
                        <option value="ga" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ga")echo "selected = 1";?>>Irish</option>
                        <option value="ig" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ig")echo "selected = 1";?>>Igbo</option>
                        <option value="ik" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ik")echo "selected = 1";?>>Inupiaq</option>
                        <option value="io" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="io")echo "selected = 1";?>>Ido</option>
                        <option value="is" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="is")echo "selected = 1";?>>Icelandic</option>
                        <option value="it" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="it")echo "selected = 1";?>>Italian</option>
                        <option value="iu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="iu")echo "selected = 1";?>>Inuktitut</option>
                        <option value="ja" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ja")echo "selected = 1";?>>Japanese</option>
                        <option value="jv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="jv")echo "selected = 1";?>>Javanese</option>
                        <option value="kl" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kl")echo "selected = 1";?>>Kalaallisut, Greenlandic</option>
                        <option value="kn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kn")echo "selected = 1";?>>Kannada</option>
                        <option value="kr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kr")echo "selected = 1";?>>Kanuri</option>
                        <option value="ks" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ks")echo "selected = 1";?>>Kashmiri</option>
                        <option value="kk" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kk")echo "selected = 1";?>>Kazakh</option>
                        <option value="km" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="km")echo "selected = 1";?>>Central Khmer</option>
                        <option value="ki" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ki")echo "selected = 1";?>>Kikuyu, Gikuyu</option>
                        <option value="rw" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="rw")echo "selected = 1";?>>Kinyarwanda</option>
                        <option value="ky" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ky")echo "selected = 1";?>>Kirghiz, Kyrgyz</option>
                        <option value="kv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kv")echo "selected = 1";?>>Komi</option>
                        <option value="kg" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kg")echo "selected = 1";?>>Kongo</option>
                        <option value="ko" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ko")echo "selected = 1";?>>Korean</option>
                        <option value="ku" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ku")echo "selected = 1";?>>Kurdish</option>
                        <option value="kj" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="kj")echo "selected = 1";?>>Kuanyama, Kwanyama</option>
                        <option value="la" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="la")echo "selected = 1";?>>Latin</option>
                        <option value="lb" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="lb")echo "selected = 1";?>>Luxembourgish, Letzeburgesch</option>
                        <option value="lg" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="lg")echo "selected = 1";?>>Ganda</option>
                        <option value="li" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="li")echo "selected = 1";?>>Limburgan, Limburger, Limburgish</option>
                        <option value="ln" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ln")echo "selected = 1";?>>Lingala</option>
                        <option value="lo" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="lo")echo "selected = 1";?>>Lao</option>
                        <option value="lt" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="lt")echo "selected = 1";?>>Lithuanian</option>
                        <option value="lu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="lu")echo "selected = 1";?>>Luba-Katanga</option>
                        <option value="lv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="lv")echo "selected = 1";?>>Latvian</option>
                        <option value="gv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="gv")echo "selected = 1";?>>Manx</option>
                        <option value="mk" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="mk")echo "selected = 1";?>>Macedonian</option>
                        <option value="mg" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="mg")echo "selected = 1";?>>Malagasy</option>
                        <option value="ms" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ms")echo "selected = 1";?>>Malay</option>
                        <option value="ml" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ml")echo "selected = 1";?>>Malayalam</option>
                        <option value="mt" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="mt")echo "selected = 1";?>>Maltese</option>
                        <option value="mi" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="mi")echo "selected = 1";?>>Maori</option>
                        <option value="mr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="mr")echo "selected = 1";?>>Marathi</option>
                        <option value="mh" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="mh")echo "selected = 1";?>>Marshallese</option>
                        <option value="mn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="mm")echo "selected = 1";?>>Mongolian</option>
                        <option value="na" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="na")echo "selected = 1";?>>Nauru</option>
                        <option value="nv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="nv")echo "selected = 1";?>>Navajo, Navaho</option>
                        <option value="nd" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="nd")echo "selected = 1";?>>North Ndebele</option>
                        <option value="ne" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ne")echo "selected = 1";?>>Nepali</option>
                        <option value="ng" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ng")echo "selected = 1";?>>Ndonga</option>
                        <option value="nb" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="nb")echo "selected = 1";?>>Norwegian Bokmål</option>
                        <option value="nn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="nn")echo "selected = 1";?>>Norwegian Nynorsk</option>
                        <option value="no" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="no")echo "selected = 1";?>>Norwegian</option>
                        <option value="ii" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ii")echo "selected = 1";?>>Sichuan Yi, Nuosu</option>
                        <option value="nr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="vi")echo "selected = 1";?>>South Ndebele</option>
                        <option value="oc" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="oc")echo "selected = 1";?>>Occitan</option>
                        <option value="oj" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="oj")echo "selected = 1";?>>Ojibwa</option>
                        <option value="cu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="cu")echo "selected = 1";?>>Church Slavic, Church Slavonic, Old Church Slavonic, Old Slavonic, Old Bulgarian</option>
                        <option value="om" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="om")echo "selected = 1";?>>Oromo</option>
                        <option value="or" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="or")echo "selected = 1";?>>Oriya</option>
                        <option value="os" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="os")echo "selected = 1";?>>Ossetian, Ossetic</option>
                        <option value="pa" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="pa")echo "selected = 1";?>>Panjabi, Punjabi</option>
                        <option value="pi" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="pi")echo "selected = 1";?>>Pali</option>
                        <option value="fa" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="fa")echo "selected = 1";?>>Persian</option>
                        <option value="pl" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="pl")echo "selected = 1";?>>Polish</option>
                        <option value="ps" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ps")echo "selected = 1";?>>Pashto, Pushto</option>
                        <option value="pt" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="pt")echo "selected = 1";?>>Portuguese</option>
                        <option value="qu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="qu")echo "selected = 1";?>>Quechua</option>
                        <option value="rm" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="rm")echo "selected = 1";?>>Romansh</option>
                        <option value="rn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="rn")echo "selected = 1";?>>Rundi</option>
                        <option value="ro" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ro")echo "selected = 1";?>>Romanian, Moldavian, Moldovan</option>
                        <option value="ru" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ru")echo "selected = 1";?>>Russian</option>
                        <option value="sa" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sa")echo "selected = 1";?>>Sanskrit</option>
                        <option value="sc" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sc")echo "selected = 1";?>>Sardinian</option>
                        <option value="sd" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sd")echo "selected = 1";?>>Sindhi</option>
                        <option value="se" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="se")echo "selected = 1";?>>Northern Sami</option>
                        <option value="sm" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="vi")echo "selected = 1";?>>Samoan</option>
                        <option value="sg" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sm")echo "selected = 1";?>>Sango</option>
                        <option value="sr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sr")echo "selected = 1";?>>Serbian</option>
                        <option value="gd" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="gd")echo "selected = 1";?>>Gaelic, Scottish Gaelic</option>
                        <option value="sn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sn")echo "selected = 1";?>>Shona</option>
                        <option value="si" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="si")echo "selected = 1";?>>Sinhala, Sinhalese</option>
                        <option value="sk" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sk")echo "selected = 1";?>>Slovak</option>
                        <option value="sl" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sl")echo "selected = 1";?>>Slovenian</option>
                        <option value="so" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="so")echo "selected = 1";?>>Somali</option>
                        <option value="st" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="st")echo "selected = 1";?>>Southern Sotho</option>
                        <option value="es" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="es")echo "selected = 1";?>>Spanish, Castilian</option>
                        <option value="su" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="su")echo "selected = 1";?>>Sundanese</option>
                        <option value="sw" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sw")echo "selected = 1";?>>Swahili</option>
                        <option value="ss" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ss")echo "selected = 1";?>>Swati</option>
                        <option value="sv" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="sv")echo "selected = 1";?>>Swedish</option>
                        <option value="ta" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ta")echo "selected = 1";?>>Tamil</option>
                        <option value="te" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="te")echo "selected = 1";?>>Telugu</option>
                        <option value="tg" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="tg")echo "selected = 1";?>>Tajik</option>
                        <option value="th" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="th")echo "selected = 1";?>>Thai</option>
                        <option value="bo" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="bo")echo "selected = 1";?>>Tibetan</option>
                        <option value="tk" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="tk")echo "selected = 1";?>>Turkmen</option>
                        <option value="tl" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="tl")echo "selected = 1";?>>Tagalog</option>
                        <option value="tn" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="tn")echo "selected = 1";?>>Tswana</option>
                        <option value="to" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="to")echo "selected = 1";?>>Tonga (Tonga Islands)</option>
                        <option value="tr" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="tr")echo "selected = 1";?>>Turkish</option>
                        <option value="ts" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ts")echo "selected = 1";?>>Tsonga</option>
                        <option value="tt" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="tt")echo "selected = 1";?>>Tatar</option>
                        <option value="tw" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="tw")echo "selected = 1";?>>Twi</option>
                        <option value="ty" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ty")echo "selected = 1";?>>Tahitian</option>
                        <option value="ug" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ug")echo "selected = 1";?>>Uighur, Uyghur</option>
                        <option value="uk" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="uk")echo "selected = 1";?>>Ukrainian</option>
                        <option value="ur" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ur")echo "selected = 1";?>>Urdu</option>
                        <option value="uz" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="uz")echo "selected = 1";?>>Uzbek</option>
                        <option value="ve" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="ve")echo "selected = 1";?>>Venda</option>
                        <option value="vi" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="vi")echo "selected = 1";?>>Vietnamese</option>
                        <option value="vo" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="vo")echo "selected = 1";?>>Volapük</option>
                        <option value="wa" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="wa")echo "selected = 1";?>>Walloon</option>
                        <option value="cy" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="cy")echo "selected = 1";?>>Welsh</option>
                        <option value="wo" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="wo")echo "selected = 1";?>>Wolof</option>
                        <option value="fy" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="fy")echo "selected = 1";?>>Western Frisian</option>
                        <option value="xh" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="xh")echo "selected = 1";?>>Xhosa</option>
                        <option value="yi" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="yi")echo "selected = 1";?>>Yiddish</option>
                        <option value="yo" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="yo")echo "selected = 1";?>>Yoruba</option>
                        <option value="za" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="za")echo "selected = 1";?>>Zhuang, Chuang</option>
                        <option value="zu" <?php if($response['items'][0]['snippet']['defaultAudioLanguage']=="zu")echo "selected = 1";?>>Zulu</option>
                        <option value=""  <?php if(empty($response['items'][0]['snippet']['defaultAudioLanguage']))echo "selected = 1";?> >Chọn ngôn ngữ  </option>
                    </select>
                    <br>
                </div>
				    <div class="col-sm-12">
                    <label >Trạng thái</label>
                    <select class="form-control input_select col-lg-12" id="StatusAdd" name="StatusAdd" >
                        <option  value="public" <?php echo $selectPublic; ?>>Công khai</option>
                        <option  value="unlisted" <?php echo $selectUnlisted ?>>Không công khai</option>
                        <option  value="private" <?php echo $selectPrivate;?>>Riêng tư</option>
                        <option <?php echo $hiddenscheduled;?> value="scheduled" <?php echo $selectScheduled;?>>Đặt lịch</option>
                    </select>
                </div>
				<br>
                <div class="col-sm-12" <?php echo $hiddenTime;?>>
                    <label " >Thời gian publish video</label> <br>
                    <div class="col-sm-4">
                        <label>Ngày</label>
                        <input class="form-control m-bot15" id ="publishDateTime" name = "publishDateTime" type="date" value="<?php echo $publishDateTime;?>">
                    </div>
                    <div class="col-sm-4">
                        <label>Giờ</label>
                        <select class="form-control m-bot15" id="publishHour" name="publishHour">
                            <?php for($i = 0; $i<24; $i++) {
                                ?>
                                <option value="<?php echo $i; ?>" <?php if($i == $publishHour) echo "selected";?>><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Phút</label>
                        <select class="form-control m-bot15" id="publishMinute" name="publishMinute">
                            <?php for($i = 0; $i<=59; $i+=15) {
                                ?>
                                <option value="<?php echo $i; ?>" <?php if($i == $publishMinute) echo "selected";?> ><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
			</body>
                <section class="panel">
                    <div class="panel-body">
                        <a href="<?php echo BASE_PATH; ?>admin/controller/c_video_manager.php?controller=video_manager" id="default-next-0" class="button-next btn btn-warning" style="float: left">Thoát</a>
                        <input type="submit" id="btn_update_video" onmouseover =  "CheckFormBeforSubmit();" class="button-next btn btn-info" name="add" value="Lưu" />
                    </div>
                </section>
            </form>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

