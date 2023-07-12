<?
$aMenuLinks = Array(
	Array(
		"Оформление заявки", 
		"https://intranet.gctm.ru/services/lists/?mode=edit&list_id=64&section_id=0&element_id=0&list_section_id=", 
		Array("services/res_c.php"), 
		Array(), 
		"CBXFeatures::IsFeatureEnabled('MeetingRoomBookingSystem')" 
	),
	Array(
		"Ваши заявки", 
		"/komandirovki/", 
		Array(), 
		Array(), 
		"CBXFeatures::IsFeatureEnabled('Lists')" 
	),
	Array(
		"Согласование заявок", 
		"https://intranet.gctm.ru/company/personal/bizproc/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"История согласований", 
		"/komandirovki/history.php", 
		Array(), 
		Array(), 
		"" 
	)
);
?>