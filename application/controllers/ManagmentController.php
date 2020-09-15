<?php
/*
 * Создан: 08.11.2007 10:27:58
 * Автор: Александр Перов
 */

	require_once 'Zend_Controller_ActionWithInit.php';
	/*
	require_once 'application/models/Users.php';
	require_once 'application/models/Events.php';
	require_once 'application/models/Companies.php';
	*/
	
    require_once 'Zend/Validate/Digits.php';
    require_once 'Zend/Validate/NotEmpty.php';
    require_once 'Zend/Validate/EmailAddress.php';

    


	class ManagmentController extends Zend_Controller_ActionWithInit{

        public function preDispatch(){
            parent::preDispatch();
            if (!$this->session->is_super_user) $this->_redirect("/index");
            $this->view->doNotShowPDAlink = true;
            $this->trackPages();
        }

		public function indexAction($notify=array ()) {
           // $this->help->resetAfter(14);
//           array ('company_id' => $company_id, 'new_manager_name' => $new_manager_name)

            if ( ! empty ( $notify ['company_id'] ) )
            {
                $query = "select name from dacons_companies where id = " . intval ( $notify ['company_id']);
                $row = $this->db->fetchRow($query);
                $company_name = $row["name"];
                $this->view->transfer_notify = sprintf (_("Компания %s успешно передана менеджеру %s"), $company_name, $notify ['new_manager_name']);
            }

            $this->template = "managment/index";
            if (is_null($this->getRequest()->getParam('id'))) {
                $this->view->showInfo = true;
            }
			global $conf; 
			$key = $conf ['license'];
			eval(base64_decode("JGNvZGUgPSBzdWJzdHIgKCRrZXksIDAsIDE0KTsgQGV2YWwgKGJhc2U2NF9kZWNvZGUgKCdKR052WkdVZ1BTQnpkSEowYjJ4dmQyVnlLQ1JqYjJSbEtUc2tkWE5sY25NZ1BTQW9KR052WkdWYk5WMHFNVEFnS3lBa1kyOWtaVnM0WFNrcU5Uc2tZV3hzYjNkbFpGOXplVzFpYjJ4eklEMGdJakl6TkRVMk56ZzVZV0pqWkdWbmFHdHRibkJ4YzNWMmVIbDZJanNrYzNsdFltOXNjMTlqYjNWdWRDQTlJSE4wY214bGJpQW9KR0ZzYkc5M1pXUmZjM2x0WW05c2N5azdKR2xrSUQwZ01EdG1iM0lnS0NScElEMGdNRHNnSkdrZ1BDQTBPeUFrYVNBckt5a2dleVJzWlhSMFpYSWdQU0J6ZEhKd2IzTWdLQ1JoYkd4dmQyVmtYM041YldKdmJITXNJQ1JqYjJSbElGc2thVjBwT3lSc1pYUjBaWElnUFNBa2MzbHRZbTlzYzE5amIzVnVkQ0F0SUNSc1pYUjBaWElnTFNBeE95UnBaQ0FyUFNBa2JHVjBkR1Z5SUNvZ2NHOTNJQ2drYzNsdFltOXNjMTlqYjNWdWRDd2dKR2twTzMwa2MzUnlJRDBnSW5KNVkySnJiV2hpSWpza2MzUnlYMnhsYmlBOUlITjBjbXhsYmlBb0pITjBjaWs3WlhaaGJDQW9ZbUZ6WlRZMFgyUmxZMjlrWlNBb0owcElWV2RKUkRCbldUSldjR0pEUVc5S1NGWjZXbGhLZWtsRE9HZE9VMnMzU2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVVRTVTVU5KZVUxNlVURk9hbU0wVDFkR2FWa3lVbXhhTW1oeVlsYzFkMk5ZVGpGa2JtZzFaV2xKTjBwSVRqVmlWMHAyWWtoT1psa3lPVEZpYmxGblVGTkNlbVJJU25OYVZ6Um5TME5TYUdKSGVIWmtNbFpyV0ROT05XSlhTblppU0Uxd1QzbFNlbHBZU25CWlYzZG5VRk5CYmtwNmRHMWlNMGxuUzBOU2NFbEVNR2ROUkhOblNrZHJaMUJEUVd0ak0xSjVXREo0YkdKcWMyZEtSMnRuUzNsemNFbElkSEJhYVVGdlNrZHJaMHBUUVhsSlJEQTVTVVJCY0VsSWMydGlSMVl3WkVkV2VVbEVNR2RqTTFKNVkwYzVla2xEWjJ0WlYzaHpZak5rYkZwR09YcGxWekZwWWpKNGVreERRV3RqTTFKNVYzbFNjRmhUYTJkTGVVSjZaRWhLZDJJelRXZExRMUpvWWtkNGRtUXlWbXRZTTA0MVlsZEtkbUpJVFhOSlExSjZaRWhKWjFkNVVuQkxla1prUzFSME9WcFhlSHBhVTBJM1NrZDRiR1JJVW14amFVRTVTVWhPTUdOdVFuWmplVUZ2U2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVYZG5Ta2hPTUdOc2MydGhWakJ3U1VOeloyTXpVbmxqUnpsNlNVTm5hMWxYZUhOaU0yUnNXa1k1ZW1WWE1XbGlNbmg2VEVOQmEyTXpVbmxKUm5OcllWTXdlRmhUYXpkbVUxSnpXbGhTTUZwWVNXZFFVMEZyWWtkV01HUkhWbmxKUTFWblNraE9OV0pYU25aaVNFNW1XVEk1TVdKdVVUZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkWWFVRnJZVmRSTjBwSGVHeGtTRkpzWTJsQk9VbERVbk5hV0ZJd1dsaEpaMWhwUVd0a1ZITnJZa2RXTUdSSFZubEpRM001U1VOU2NGcERRWEpKUTFKeldsaFNNRnBZU1dkUWFqUm5Ta2RyWjB0NVFXdGhWSE5yWWtkV01HUkhWbmxKUkRCblNrZDRiR1JJVW14amFVRXJVR2xCZVU5NVVuTmFXRkl3V2xoSloxQlRRV3RpUjFZd1pFZFdlVWxHTkdkS1NFNDFZbGRLZG1KSVRtWlpNamt4WW01Uk4wcEhlR3hrU0ZKc1kybEJjVkJUUW5wa1NFcDNZak5OWjB0RFVtaGlSM2gyWkRKV2ExZ3pUalZpVjBwMllraE5jMGxEVW5wa1NFbG5WM2xTY0ZoVGF6ZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkS1UwRnJZek5zZEZsdE9YTmpNVGxxWWpOV2RXUkVjMnRpUjFZd1pFZFdlVWxFTUdkS1IwWnpZa2M1TTFwWFVtWmpNMngwV1cwNWMyTjVRbUpLUjNoc1pFaFNiR05zTURkS1NFNXNZMjFzYUdKRFFYVlFVMEZyWWtkV01HUkhWbmxQTXpGc1pHMUdjMGxEYUdsWldFNXNUbXBTWmxwSFZtcGlNbEpzU1VObmJsRXliRk5sYkhCWlUyNUNXbFl6YUcxWmJHUkhUa1puZVdWSGVHbGhWVVUxVTFWU2JrNHdjRWhPVjNoclRWUnNObGRzYUV0alJteFlaREprVVZVd1NtOVpNalZMWVVkV1ZGRlhPVXhXU0U1eVdYcEtWMlZYUmxoU2JrNVpUVzVvYzFsdGJFSlBWV3hKVkdwQ2FtSllhSE5aYld4Q1lqQndTVlJ0ZUdwaVYzaHZXV3RPY2s0eGNIUlBXR3hLVVRKa2NsbFdUa0pQVld4RlVWUmtTbEV4U25kVFZWSXpXakJ3U1ZScVFtcGlSR3g2VjJ4ak1FNHdiRVJWYmtKS1VUTk9lVk14VGtOT01rWllWMWRrVEZFeFNuZFRWVkl6V2pCd1NWUnRlR3BpVjNodldXdFpOV1JHYkZsaFIxcHBVakZhTVZNeFRrTk9NSEJJVGxkNGEwMVViRFpYYkdoTFkwWnNXR1F5WkZobFZrcDNWMFpPUWs5VmJFbFVha0pxWW10S01sa3piRUppTUhCSVVtNU9hVko2YTNwWGJHUlRXbTFOZW1KSVVscGlWR3g2V1ROc00xb3djRWxVYlhocVlsZDRiMWxyVGtOWmEzQklZa2RTVEZaSVVUVlhiR1EwWld4d1ZGRnFaRXRTZWxaeldrUkZOV1ZzY0ZsVGJrSmFWak5rYmxZemJGTmpSWEJWWWtkU1NsRXpUVFZUVldoUFRVZE9kVkZ1V21wbFZVWjJVMnRrUjJNeVNraFBWRTVoVmpGS2JWbDZUbk5rUm14MFQxaE9hbVZZWkc1VGEyaFBZa2RPZEdKSGFHbFJNRXBwVTJ0a2MxcEZkRlZrUkd4dFZqRndNbGt5TVZkaFJtdDVXakprVEZFeFNqRlhiR2hyV20xTmVWWnViR2hXTUZwNlUxVmtSMlZyYkVSVmJrSktVa1JCY2xOVlRscGFNSEJJWlVkNGExTkdTbk5aTW14eVdqSldOVlZ1VG1GWFJrbDNWMnhvU2xveFFsUlJWM1JxVFRKNE1GZFhNRFZqTWsxNFQxZHdhVTB4V2pGYVJVNUNaRVZzUlZKWFpFMVZNRVp5V1d0a1YwMUhVa2hXYm14S1VURldibE5yYUU5T1YwcFlVMjVhYVZORk5XMVhWRWsxVFZkS2RWVlVaRXRTTTJoeldrVm9VMkpIVG5CUlZHeEtVVEZLYjFsclpEUmtiVkY1Vm0xMFdVMHdOREZaYkdSTFpHMUtTVlJYWkZobFZrcDZWMnhvVTAxR2NGbFRiVkpRVFhwR2MxcEhNVWRqTUd4RVlVZHNXbGRGTlhOVWJYQlRXbXh3U0ZadGNHbE5iRXB6VTFWT2JtRldaSFJOUkZac1ZtNUNXVlZ0TVhkaFJrVjNVbTVhVkdFeVRYaFphMlJTWlVVNVdXTkhSbGhTV0VJelZqRmFhMDB4YjNoaVJteFZWakpTVEZWcVNqQmliRlpIVlZSQ1lVMUlRa2xhVldRMFlURk9SMU51VGxwTmJYaDVWMnBLVjA1V1ZuVlViVVpZVW10c00xWXllRzlUYkc5NFVXeFNVbFl6VW05V1ZFSkhaVVpPVmxWck5VNVNWM2hGV1hwS2EyRlZNSGRqU0VwVVZsVTFkVmxVU2t0VFJscHhVVzEwVTAxV2J6RlZla1pQVVcxU1JtSkZiRlZoYTBweFdXMTBTMDFzYTNwaVJVcHBUVWhDU1ZWdE5VOWhWa28yWVROd1dHSkhVbFJYYlRGT1pXMUtTVlZzY0dsV1IzZzJWMVJPYzAweGIzZGpSV2hzVWpOb2NsVXdXa3RqTVd0NVlraEtZVTFWU2taYVJFcHJWRzFHZFZSdVNscGhNbEpZVkZWa1UxTkdXblZpUlhCVFVrVktkVlV5ZEd0T1IwcElWV3RzVm1KWWFIRlpWbFpIWXpGT1ZsUnNUbXhpVmxwWlZGWmtjMkZWTVhWaFJGcFlVa1Z3VUZwSE1WTlhSVFZWVVd4Q2JGWnJjRFpXTW5odlZUQXhSMk5HYkZSV01sSlNWbFJDUjJOc1pGZGFSRkpxVFd0c05sZHJaRFJaVmtweFlrUmFZVlp0VGpSWlZtUktaVmRXU1dORmNGTmlhelY1VjFkMGExWXdNVWhWYTJoWFltMTRXbFpyYUZKT1ZrNXlXWHBHYVZJeFJqUlVNV2gzV1Zaa1JtTklaRmhXYlZFd1YyMHhUbVZzVm5WaVJYQlRVa1ZLZFZkV1kzZE9WMDVJVTI1Q1VsWjZiRXhhVm1SUFpXeE9WbFJzVG10V2JrSmFWMnRrWVdGck1YTlhhbFphVm0xU1NGbDZRakJXVjFKRlVtMXNhV0Y2Vm5wWGExWlBVVzFKZDJORmFFOVdNMmh5VkZaU2MwNXNaSE5oUlhScVVtMTRXVnBFVGtOVlIxWlhVMWhrV0dKSFRqUmFSRVp1WlZkS1NHUkZjRk5TUlVwMVZUSjBhMk15UlhkUFZGWldZbTVDY2xVd1ZuZGlWbXhYV2taS1lVMVZTbFZWVm1SelUyMUdkVlJxU2xSTmJYaFVXVEJhZDFKWFRYcFNhekZPWWtoQmVWZFVTbk5SYlVsM1kwVm9hRTF0VWxKV1ZFSkhUVEZSZW1KRlNtaE5hMXBWVlZaU2IxTnNTa2RTVkU1VVZsVTFWRmt3Vm5OU1IwMTZVMnQ0VmsxRmEzcFZNblJyVGtkS1NGVnJiRlppV0doeFdWWldSazVXVGxaYVIwWnFUV3RzTlZReGFITlRiRVY1V2toYVZHRXlVbnBaVkVKelVrWmFXRnBIY0ZObGJYUTJWVEZXVDJKdFJYbFVXSEJwVTBaS1lWbHNVbk5sYkd3MlVsUldhR0pWYkRaV2JUVlhZVEZGZWxwSE5WUmhNbEo1V1RKemVGWkhSWHBSYTNCU1pXMW9kVmRVUW1wT1ZUQjNZa1ZTWVUxdVVuRlVWRW8wVFVaa1dFMUVWbXBOYXpFMFZERmtkMkZWTUhoWGFrWmhVbFUwZWxkcVFuZFRSMFY2VVd0NFYxTkZOWGxYVjNSclZqQXhTRlZyYUZkaWJYaExWV3RTUTJKc1RuSmhSVGxQVmpCd1dWVXlOV0ZoVms1R1RsY3hXRlpGYXpGVVZtUkxaRlpXV0ZwRk1WWk5SVnA1VjFkMGExWXdNVWhWYTJoWFltMTRTMVZZY0VOaWJGSlhWVzV3YUUxcmNFbFdiWEJEWVRGSmVGZHFWbFJXVmtZelYycENkMU5HU25WVWJXeFRaVzEwTmxZeWVHdFZNWEIwVkZod2FWTkdTbUZaYkZKelpXeHJlbUpGVGxwaE0wSkpXbFZrTkdFeFRrZFRiazVhVFc1a00xUnFRbmRUVmxKeFVXMXdhVkpIZUROV01uUlBVVzFTVjFGc1VsSldNMUp3VldwR1dtUXhjRVphUm1Sc1ZsUm9ObFJXWkRSaE1rcFdWMjV3VkZaVk5YWlpWbHB6VjFaU2RHVkZPV2hpUlhCMFZqSjBhMVl5Um5SVFdHeFdZbGhvUzFWVVNtdGpSbFY1WkVkMGFrMXJWak5aYTFaWFZHeEplVlZyZUZaTlJuQk1XWHBHYzJNeVJrWlViVVpwVmxad1dsWnNXbE5oTVUxNFZHdGFUMWRGTldGVVYzQkhaV3hzVmxwRmRGTlNhMXBXV1d0V2QxVnJNVlppZWtwWVlURmFkbFY2Um5ka1JrcHpZVVphV0ZKc2NFeFhWbHBUVVRKT1IxVnJhRTVXTUZweFZGZDBjMDVXVVhoaFNFNVVZa1ZXTlZkcmFHRldSMFY1WVVaa1dHRnJTak5XYTFwSFYxZEdSazVXVGxOV1ZtOTZWbFJHVjFSck5VZGlNMlJPVm14YVUxWXdWa3RUTVZaWlkwWk9hV0pIZHpKV1IzaHJZVVpaZDAxVVdsZFdlbFo2VlRKNFJtVldjRWxUYkhCcFZrVmFXVlpHVWtkaWJWWnpWVzVTYkZJelFuQldhazV2Wkd4a1dHUkdjRTlXTVZvd1ZsZDBjMVpHWkVaT1ZYUldZVEZhU0ZwWGVFOVdiRlp5WTBkd1UxWXphRVpXUjNScllURk5lRlJyWkZkaVZGWlZXV3RWTVZFeGNGWldXR2hUVW10YVdsWnRkSGRWYXpGSVpETmtWazFYVW5sVVZtUlhaRVpXYzJGR1VtbGlhMHA1VmxSQ1YyTXlTbk5VV0dSVllrVTFjbFp0TlVOWGJHUnlXa2RHYUdGNlJucFdNbkJYVjJ4YWRGVnJhRnBsYTFwMVdsZDRVMk5XUm5SalIyaFlVakZLTVZaclpEQlVNREI0WWpOa1QxWldTbTlhVnpGVFZFWlZkMVpVUm1wTlYzUTFWRlpvVDJGR1NYZGpSVlpXVm14S2VsVXllRTlTYXpWSldrWndUbUZzV2xWWGEyTjRWVEZrVjFKdVZtRlNNRnBaVld4a05HUldWalpSYXpsV1RXeGFlbGt3V25OV1IwcHlVMjFHVjJGck5YSmFSRVpUVG14T2MxUnRiRk5pYTBsM1YxZDBiMVl4YkZkV1dHUlRZbXh3VlZacVRsSk5SbFY1WlVWYWEwMVdjSGxVTVZwaFZHeEtjMk5JVWxkaE1VcEVXbGN4UjFadFZrWlZiRXBwWW10S2VWWlVRbGRrYlZGNFlraEdWR0ZzU25KWmJGcEhUbFphZEU1WVRsVlNhMVkwVlRJMVIxZHRSbkpqUmxKYVlURlpkMVpyV2tkV1YwcEhVbXhhVGxKWE9IbFdNblJYWWpGTmQwMVZhRlJYUjNoelZUQmFkMk5zVWxobFIwWlBWbXN4TTFaSGVFOWlSMHBKVVd4d1ZrMXFWa1JXTW5oYVpXeHdTVnBHVWs1V2EyOHlWVEZrYzJOdFRrWlBWRTVSVmtSQ1RGTlhiSEpqUlRrelVGUXdia3RUYXpjbktTazcnKSk7IGlmICgkdXNlcnMgPT0gMCkgJHVzZXJzID0gMTsgaWYgKCR1c2VycyA9PSA0OTUpICR1c2VycyA9IDEwMDAwMDA7IGlmICghTElDRU5TRV9PSykgeyBpZiAoISBlbXB0eSAoJF9QT1NUIFsnY29kZSddKSkgeyAkdGhpcy0+dmlldy0+bW9kZSA9IDE7IH0gZWxzZSB7ICR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTsgfSB9IGVsc2UgeyAgaWYgKHN0cmxlbiAoJGtleSkgIT0gMTkpICB7ICR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTsgfSBlbHNlIHsgZXZhbChiYXNlNjRfZGVjb2RlKCJaWFpoYkNoaVlYTmxOalJmWkdWamIyUmxLQ0pLUjJocVlqSlNiRWxFTUdkak0xWnBZek5TZVVsRFoydGhNbFkxVEVOQmVFNVRhemRKUTFKclNVUXdaMGxEYUdsWldFNXNUbXBTWmxwWE5XcGlNbEpzU1VOb2EyRllUbkpZTTFKMlpFZEdjMWd6VG5kWlYwNXNTME5TWmxVd1ZsTldhMVpUU1VaemJsSkZPVVJXVlRGR1ZHeFNabFZyT1ZCV1EyUmtTMU5yY0U5NVFXdGphVUU1U1VOQmIxbHRSbnBhVkZrd1dESldkVmt5T1d0YVUwRnZTa1k1VkZKV1NsZFNWa2xuVjNsa1JWUXdUbFpVVlZaUFZrWTVVMVF3T1ZWS01UQndTMVJ6WjBsSFZqSlpWM2R2V1cxR2VscFVXVEJZTWxKc1dUSTVhMXBUWjJsVGEyUlBaR3h3U0ZaWFpGRlZNRVp5VjJ0Tk1HRXlUbkZqTW1SS1VURktOVmRFU2pSaVIwcHdVVlJzU2xORk5IZFpNakUwWWtkS2NGRlhPVXRUUld4M1ZETnNRbUV5VFhsV2JteG9WakJhZWxOVlVYZGFNSEExV1hwa1NsRXhTbTlaYTJRMFpHMVJlVlp0ZEZsTk1EUXhXV3hrUzJSdFNrbFVWMlJSVlRCR2NGUlhjRTVOUlRWVlYxUk9VRkpIZUc5WFZ6RlBZVEZ3V0ZwSE9XaE5ha1l4V1RCb1IyVnRVbGxYYWxKc1YwYzVjRlF6YkVKaE1rMTZZa2hTV21KVWJIcFpla1UxWVcxSmVsWnVWbXRSTUVVMVUxVm9UMDFIVG5SbFIzaHBZVlZHZGxOclpFZGpNa3BJVDFST1lWWXhTbTFaZWs1elpFWnNkRTlZVG1wbFYzTXpVMVZPUTJKWFNYcFRWMlJNVVRGS2QxTlZVWGRhTURGRll6SmtTMUl5ZEc1VlJVNURaVzFTU1ZOdVRtRldlbEp1VXpCT1UyRnRTWGxWYlhoTVZraE9ibE5yWkhKYU1IUTFZek5DU2xOSVRtNVpWbVJhV2pCMFJGVnVRa3BSTVZadVZGZHNRazlXUWxSUldHUk1WVEJKTTFOVlRsTmpNWEJaVldwQ1lWZEZiRzVWUms1RFpHMU9kRlZYWkV4Uk1VcHhXV3BLVTJKR1pEVlZia0paVlRKek0xTlZUbE5qTVhCWlZXcENZVmRGYkc1VlJrNUNZVEpLU0ZacVFtdFNNVm8xVTFWT1Zsb3djRWxVYWxacFZqQndNbGxyYUU5YWJHdDVUMVJHYVdKc1JUTlRWVTVUWXpGd1dWVnFRbUZYUld4dVV6TnZkMW93Y0VobFIzaHJVMFpLYzFreWJFSkxNVUp3VVZkMGFGVXdSbmxUVlU1VFkwVTVOVkZYWkV0U00yaHpXa1ZvVTJKSFRuQlJWR3hLVVRGS2VsZHNhRk5OUm5CWlUxZGtVV0ZxVW01VVYzQjZXakJ3U0dWSGVHdFRSa3B6V1RKc1FrOVZiRVJWYms1aFYwWkpkMWRzYUVwYU1XaHdVVlJHVGxaSFRUTlRWVTVUWXpGd1dWVnFRbUZYUld4dVV6SnZkMW95U1hwVGJYUktVVEprY2xkVVNUVmhNWEJVVVcxS1MxSXllR3RUTVZKNldqSmFWRkZ0ZUdsVFJUVnpVMVZvZWxvd2NFaGxSM2hyVTBaS2Mxa3liRUpQVld4SVQxaHNZVkV3Um5aVGEyUlBaR3h3U0ZadFNrdFNNbmhyVXpGT1FtTnJiRWhQV0d4aFVUQkdkbE5yWkU5a2JIQklWbGRrV0dWV1NuZFVSbEpIV2tWMFZHSjZRbEJsVlVrMVUxVk9VMk14Y0ZsVmFrSmhWMFZzYmxWR1RrSmhNa3BJVm1wQ2ExSXhXalZUVlU1V1dqQndTVlJxVm1sV01IQXlXV3RvVDFwc2EzbFBWRVpwWW14Rk0xTlZUbE5qTVhCWlZXcENZVmRGYkc1VlJrNUNZVEZzV0dWSVRtbE5NbEp6VjJ0Wk5XVnRWbGhOVjJ4cFRXNW9ObE5WV25waE1rcElWbXBDYTFJeFdqVlhSbEo2V2pCd1NWUnRlR3BpVjNodldXdE9RbVJXUWxSUlYzUnBVakZaZDFwRlpGZGxWVGsxVVdwcmFVdFRhemRKUTBGcll6SldlV0ZYUm5OWU1qRm9aVVk1YzFwWE5HZFFVMEV3VDNsQlowcEhOV3hrTVRsNldsaEtjRmxYZDJkUVUwSm9ZMjVLYUdWVFFXOUxWSE5uU2toT2JHTnRiR2hpUmpseldsYzBaMUJUUW5wa1NFcHpXbGMwWjB0RFVucGFXRXB3V1ZkM2NFOTVRV2RhYlRsNVNVTm5hMkZUUVRsSlJFRTNTVU5TY0VsRWQyZEtTRTVzWTIxc2FHSkdPWE5hVnpRM1NVTlNjRWxEYzNKTFUwSTNTVWRzYlVsRFoydGhVMEU0U1VOU2VscFlTbkJaVjNobVlsZEdORmd5ZUd4aWFXdG5aWGxCYTJKdFZqTllNMDVzWTIxc2FHSkRRbUpLUjJ4a1NVUXdaMHBJVG14amJXeG9Za05DWWtwSGJHUlBlVUk1U1VkV2MyTXlWV2RsZVVGclltMVdNMWd6VG14amJXeG9Za05DWWtwSGEyeE9SakJuUzNvd1owcElUbXhqYld4b1lrTkNZa3BIYkdSUGVVSTVTVWd3WjBsSFduWmpiVlpvV1RKblowdERVblZhV0dSbVl6SldlV0ZYUm5OSlIwWjZTVU5TY0VsRU1DdEpRMWxuU2tkNGJHUklVbXhqYVd0blpYbEJhMkpIVmpCa1IxWjVTVVF3WjBwSVRqVmlWMHAyWWtoT1psa3lPVEZpYmxGblRGTkJlRWxETUdkS1IzaHNaRWhTYkdOcFFXeEpRMUo2WlZjeGFXSXllSHBZTWs1MlpGYzFNRTk1UVd0aVIxWXdaRWRXZVVsRU1HZEtSMFp6WWtjNU0xcFhVbVpqTTJ4MFdXMDVjMk41UW1KS1IzaHNaRWhTYkdOc01EZEpTREE5SWlrcE95QWdabTl5SUNna2FTQTlJREE3SUNScElEd2dORHNnS3lzZ0pHa3BJSHNnSkc1bGQxOXpaWEpwWVd4YkpHbGRJRDBnSkhObGNtbGhiQ0JiSkdsZE95QjlJQ0FrWTI5a1pTQTlJR3B2YVc0Z0tDY25MQ0FrYm1WM1gzTmxjbWxoYkNrN0lDQWtZMjlrWlNBOUlITjFZbk4wY2lBb0pITmxjbWxoYkN3Z01Dd2dOQ2s3SUdsbUlDaHpkSEowYjJ4dmQyVnlJQ2drWTI5a1pTa2dJVDBnYzNSeWRHOXNiM2RsY2lBb0pHaGpiMlJsS1NrZ2V5QWdhV1lnS0NFZ1pXMXdkSGtnS0NSZlVFOVRWQ0JiSjJOdlpHVW5YU2twSUhzZ0pIUm9hWE10UG5acFpYY3RQbTF2WkdVZ1BTQXhPeUI5SUdWc2MyVWdleUFrZEdocGN5MCtYM0psWkdseVpXTjBJQ2duTDJsdVpHVjRMMkZqZEdsMllYUmxKeWs3SUgwZ2ZTQmxiSE5sYVdZZ0tDUjFjMlZ5Y3p3ME9UVXBJSHNnSkhGMVpYSjVJRDBnSjFORlRFVkRWQ0JqYjNWdWRDaHBaQ2tnWVhNZ2JuVnRJRVpTVDAwZ1pHRmpiMjV6WDNWelpYSnpJRmRJUlZKRklHTjFjM1J2YldWeVgybGtJRDBnSnk1cGJuUjJZV3dvSkhSb2FYTXRQbk5sYzNOcGIyNHRQbU4xYzNSdmJXVnlYMmxrS1M0bklFRk9SQ0J5WldGa2IyNXNlVHcrTVNCQlRrUWdhWE5mWVdSdGFXNGdQU0F3SnpzZ0pISnZkeUE5SUNSMGFHbHpMVDVrWWkwK1ptVjBZMmhTYjNjZ0tDUnhkV1Z5ZVNrN0lHbG1JQ2drY205M0lGc25iblZ0SjEwZ1BpQWtkWE5sY25NcElIc2dhV1lnS0NFZ1pXMXdkSGtnS0NSZlVFOVRWQ0JiSjJOdlpHVW5YU2twSUhzZ0pIUm9hWE10UG5acFpYY3RQbTF2WkdVZ1BTQXhPeUFrZEdocGN5MCtkbWxsZHkwK2QyVmZibVZsWkY5dGIzSmxYM1Z6WlhKeklEMGdkSEoxWlRzZ2ZTQmxiSE5sSUhzZ0pIUm9hWE10UGw5eVpXUnBjbVZqZENBb0p5OXBibVJsZUM5aFkzUnBkbUYwWlNjcE95QjlJSDBnWld4elpTQjdJQ1IwYUdsekxUNTJhV1YzTFQ1dGIyUmxJRDBnTWpzZ2ZTQjlJR1ZzYzJVZ2V5QWtkR2hwY3kwK2RtbGxkeTArYlc5a1pTQTlJREk3SUgwPSIpKTsgfSB9"));




			$id = $this->getRequest()->getParam("id");
            if (!is_numeric($id) || $id=="") {
                $temp = $this->db->fetchRow("SELECT id FROM dacons_users WHERE customer_id='".$this->session->customer_id."' LIMIT 1");
                $id = $temp["id"];
            }
			
            $this->displayManagers($this->session);   

            $this->viewManager($id);
            $this->viewManagerCompanies($id);


		}

		public function customerAction() {
			$this->displayManagers($this->session);
			$row = $this->db->fetchRow("SELECT * FROM `dacons_customers` where `id` = '".$this->session->customer_id."'");
			$this->view->customer = $row["name"];
			$this->template = "managment/customer";
		}

		public function customerSubmitAction() {
			$this->displayManagers($this->session);
            if ($this->getRequest()->getParam('customer')){
				$company = $this->getRequest()->getParam('customer');
			}

            $valid = true;
            $errors = array();

            require_once 'Zend/Validate/NotEmpty.php';
        	$validator = new Zend_Validate_NotEmpty();
        	if (!$validator->isValid($company)) {
                $valid = false;
                $error['company'] = _("Не введена компания");
			}

			require_once 'Zend/Validate/LessThan.php';
			$validator = new Zend_Validate_LessThan(25);
        	if (!$validator->isValid(strlen(utf8_decode($company)))) {
                $valid = false;
                $error['company'] = _("Слишком длинное название<br> Длина строки не должна превышать 25 символов");
			}

			if (!$valid) {
				$this->view->errors = $error;
				$this->customerAction();
			} else
			{
				//require_once 'application/models/Customers.php';
				//$customers = new Customers();
				//$customers->update(array('name' => $company),"`id` = '".$this->session->customer_id."'");
				$query = "update dacons_customers set name = '$company' where id = ".$this->session->customer_id;
                                $this->db->query ($query);
				$this->view->customer = $company;
				$this->session->usercompany=$company;
				$this->template = "managment/customerSuccess";
			}
		}

        public function delclientAction()
		{
			$this->displayManagers($this->session);

			if (is_null($this->getRequest()->getParam('company')))
			{
				$this->view->allCompanies = $this->db->fetchAll("SELECT id, name FROM dacons_companies ORDER BY name");
				$this->template = "managment/delClient";
			}
			else
			{
				$company_id = $this->getRequest()->getParam('company');
				$validator = new Zend_Validate_Digits();
				if (!$validator->isValid($company_id)) {
                	$this->_redirect($this->getInvokeArg('url')."error");
				}
				$this->view->company = $this->db->fetchAll("SELECT id, name FROM dacons_companies WHERE id = $company_id");
				$this->template = "managment/delClientSubmit";
			}
		}

		public function delClientSubmitAction()
		{
			$this->displayManagers($this->session);

			$company_id = $this->getRequest()->getParam('id');
			$validator = new Zend_Validate_Digits();
			if (!$validator->isValid($company_id)) {
                $this->_redirect($this->getInvokeArg('url')."/managment/delClient");
            }
			
			$this->db->query("DELETE FROM dacons_companies_labels WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_company_properties WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_events WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_favorite_companies WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_history WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_people WHERE id IN (SELECT person_id FROM dacons_people_company WHERE company_id=$company_id)");
			$this->db->query("DELETE FROM dacons_people_company WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_reminderspool WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_uploads WHERE company_id=$company_id");
			$this->db->query("DELETE FROM dacons_companies WHERE id=$company_id");
			$this->_redirect($this->getInvokeArg('url')."/managment/delClient");
		}
		
        public function newManagerAction() {
            //global $conf; $key = $conf ['license'];@eval(base64_decode("JGNvZGUgPSBzdWJzdHIgKCRrZXksIDAsIDE0KTsgQGV2YWwgKGJhc2U2NF9kZWNvZGUgKCdKR052WkdVZ1BTQnpkSEowYjJ4dmQyVnlLQ1JqYjJSbEtUc2tkWE5sY25NZ1BTQW9KR052WkdWYk5WMHFNVEFnS3lBa1kyOWtaVnM0WFNrcU5Uc2tZV3hzYjNkbFpGOXplVzFpYjJ4eklEMGdJakl6TkRVMk56ZzVZV0pqWkdWbmFHdHRibkJ4YzNWMmVIbDZJanNrYzNsdFltOXNjMTlqYjNWdWRDQTlJSE4wY214bGJpQW9KR0ZzYkc5M1pXUmZjM2x0WW05c2N5azdKR2xrSUQwZ01EdG1iM0lnS0NScElEMGdNRHNnSkdrZ1BDQTBPeUFrYVNBckt5a2dleVJzWlhSMFpYSWdQU0J6ZEhKd2IzTWdLQ1JoYkd4dmQyVmtYM041YldKdmJITXNJQ1JqYjJSbElGc2thVjBwT3lSc1pYUjBaWElnUFNBa2MzbHRZbTlzYzE5amIzVnVkQ0F0SUNSc1pYUjBaWElnTFNBeE95UnBaQ0FyUFNBa2JHVjBkR1Z5SUNvZ2NHOTNJQ2drYzNsdFltOXNjMTlqYjNWdWRDd2dKR2twTzMwa2MzUnlJRDBnSW5KNVkySnJiV2hpSWpza2MzUnlYMnhsYmlBOUlITjBjbXhsYmlBb0pITjBjaWs3WlhaaGJDQW9ZbUZ6WlRZMFgyUmxZMjlrWlNBb0owcElWV2RKUkRCbldUSldjR0pEUVc5S1NGWjZXbGhLZWtsRE9HZE9VMnMzU2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVVRTVTVU5KZVUxNlVURk9hbU0wVDFkR2FWa3lVbXhhTW1oeVlsYzFkMk5ZVGpGa2JtZzFaV2xKTjBwSVRqVmlWMHAyWWtoT1psa3lPVEZpYmxGblVGTkNlbVJJU25OYVZ6Um5TME5TYUdKSGVIWmtNbFpyV0ROT05XSlhTblppU0Uxd1QzbFNlbHBZU25CWlYzZG5VRk5CYmtwNmRHMWlNMGxuUzBOU2NFbEVNR2ROUkhOblNrZHJaMUJEUVd0ak0xSjVXREo0YkdKcWMyZEtSMnRuUzNsemNFbElkSEJhYVVGdlNrZHJaMHBUUVhsSlJEQTVTVVJCY0VsSWMydGlSMVl3WkVkV2VVbEVNR2RqTTFKNVkwYzVla2xEWjJ0WlYzaHpZak5rYkZwR09YcGxWekZwWWpKNGVreERRV3RqTTFKNVYzbFNjRmhUYTJkTGVVSjZaRWhLZDJJelRXZExRMUpvWWtkNGRtUXlWbXRZTTA0MVlsZEtkbUpJVFhOSlExSjZaRWhKWjFkNVVuQkxla1prUzFSME9WcFhlSHBhVTBJM1NrZDRiR1JJVW14amFVRTVTVWhPTUdOdVFuWmplVUZ2U2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVYZG5Ta2hPTUdOc2MydGhWakJ3U1VOeloyTXpVbmxqUnpsNlNVTm5hMWxYZUhOaU0yUnNXa1k1ZW1WWE1XbGlNbmg2VEVOQmEyTXpVbmxKUm5OcllWTXdlRmhUYXpkbVUxSnpXbGhTTUZwWVNXZFFVMEZyWWtkV01HUkhWbmxKUTFWblNraE9OV0pYU25aaVNFNW1XVEk1TVdKdVVUZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkWWFVRnJZVmRSTjBwSGVHeGtTRkpzWTJsQk9VbERVbk5hV0ZJd1dsaEpaMWhwUVd0a1ZITnJZa2RXTUdSSFZubEpRM001U1VOU2NGcERRWEpKUTFKeldsaFNNRnBZU1dkUWFqUm5Ta2RyWjB0NVFXdGhWSE5yWWtkV01HUkhWbmxKUkRCblNrZDRiR1JJVW14amFVRXJVR2xCZVU5NVVuTmFXRkl3V2xoSloxQlRRV3RpUjFZd1pFZFdlVWxHTkdkS1NFNDFZbGRLZG1KSVRtWlpNamt4WW01Uk4wcEhlR3hrU0ZKc1kybEJjVkJUUW5wa1NFcDNZak5OWjB0RFVtaGlSM2gyWkRKV2ExZ3pUalZpVjBwMllraE5jMGxEVW5wa1NFbG5WM2xTY0ZoVGF6ZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkS1UwRnJZek5zZEZsdE9YTmpNVGxxWWpOV2RXUkVjMnRpUjFZd1pFZFdlVWxFTUdkS1IwWnpZa2M1TTFwWFVtWmpNMngwV1cwNWMyTjVRbUpLUjNoc1pFaFNiR05zTURkS1NFNXNZMjFzYUdKRFFYVlFVMEZyWWtkV01HUkhWbmxQTXpGc1pHMUdjMGxEYUdsWldFNXNUbXBTWmxwSFZtcGlNbEpzU1VObmJsRXliRk5sYkhCWlUyNUNXbFl6YUcxWmJHUkhUa1puZVdWSGVHbGhWVVUxVTFWU2JrNHdjRWhPVjNoclRWUnNObGRzYUV0alJteFlaREprVVZVd1NtOVpNalZMWVVkV1ZGRlhPVXhXU0U1eVdYcEtWMlZYUmxoU2JrNVpUVzVvYzFsdGJFSlBWV3hKVkdwQ2FtSllhSE5aYld4Q1lqQndTVlJ0ZUdwaVYzaHZXV3RPY2s0eGNIUlBXR3hLVVRKa2NsbFdUa0pQVld4RlVWUmtTbEV4U25kVFZWSXpXakJ3U1ZScVFtcGlSR3g2VjJ4ak1FNHdiRVJWYmtKS1VUTk9lVk14VGtOT01rWllWMWRrVEZFeFNuZFRWVkl6V2pCd1NWUnRlR3BpVjNodldXdFpOV1JHYkZsaFIxcHBVakZhTVZNeFRrTk9NSEJJVGxkNGEwMVViRFpYYkdoTFkwWnNXR1F5WkZobFZrcDNWMFpPUWs5VmJFbFVha0pxWW10S01sa3piRUppTUhCSVVtNU9hVko2YTNwWGJHUlRXbTFOZW1KSVVscGlWR3g2V1ROc00xb3djRWxVYlhocVlsZDRiMWxyVGtOWmEzQklZa2RTVEZaSVVUVlhiR1EwWld4d1ZGRnFaRXRTZWxaeldrUkZOV1ZzY0ZsVGJrSmFWak5rYmxZemJGTmpSWEJWWWtkU1NsRXpUVFZUVldoUFRVZE9kVkZ1V21wbFZVWjJVMnRrUjJNeVNraFBWRTVoVmpGS2JWbDZUbk5rUm14MFQxaE9hbVZZWkc1VGEyaFBZa2RPZEdKSGFHbFJNRXBwVTJ0a2MxcEZkRlZrUkd4dFZqRndNbGt5TVZkaFJtdDVXakprVEZFeFNqRlhiR2hyV20xTmVWWnViR2hXTUZwNlUxVmtSMlZyYkVSVmJrSktVa1JCY2xOVlRscGFNSEJJWlVkNGExTkdTbk5aTW14eVdqSldOVlZ1VG1GWFJrbDNWMnhvU2xveFFsUlJWM1JxVFRKNE1GZFhNRFZqTWsxNFQxZHdhVTB4V2pGYVJVNUNaRVZzUlZKWFpFMVZNRVp5V1d0a1YwMUhVa2hXYm14S1VURldibE5yYUU5T1YwcFlVMjVhYVZORk5XMVhWRWsxVFZkS2RWVlVaRXRTTTJoeldrVm9VMkpIVG5CUlZHeEtVVEZLYjFsclpEUmtiVkY1Vm0xMFdVMHdOREZaYkdSTFpHMUtTVlJYWkZobFZrcDZWMnhvVTAxR2NGbFRiVkpRVFhwR2MxcEhNVWRqTUd4RVlVZHNXbGRGTlhOVWJYQlRXbXh3U0ZadGNHbE5iRXB6VTFWT2JtRldaSFJOUkZac1ZtNUNXVlZ0TVhkaFJrVjNVbTVhVkdFeVRYaFphMlJTWlVVNVdXTkhSbGhTV0VJelZqRmFhMDB4YjNoaVJteFZWakpTVEZWcVNqQmliRlpIVlZSQ1lVMUlRa2xhVldRMFlURk9SMU51VGxwTmJYaDVWMnBLVjA1V1ZuVlViVVpZVW10c00xWXllRzlUYkc5NFVXeFNVbFl6VW05V1ZFSkhaVVpPVmxWck5VNVNWM2hGV1hwS2EyRlZNSGRqU0VwVVZsVTFkVmxVU2t0VFJscHhVVzEwVTAxV2J6RlZla1pQVVcxU1JtSkZiRlZoYTBweFdXMTBTMDFzYTNwaVJVcHBUVWhDU1ZWdE5VOWhWa28yWVROd1dHSkhVbFJYYlRGT1pXMUtTVlZzY0dsV1IzZzJWMVJPYzAweGIzZGpSV2hzVWpOb2NsVXdXa3RqTVd0NVlraEtZVTFWU2taYVJFcHJWRzFHZFZSdVNscGhNbEpZVkZWa1UxTkdXblZpUlhCVFVrVktkVlV5ZEd0T1IwcElWV3RzVm1KWWFIRlpWbFpIWXpGT1ZsUnNUbXhpVmxwWlZGWmtjMkZWTVhWaFJGcFlVa1Z3VUZwSE1WTlhSVFZWVVd4Q2JGWnJjRFpXTW5odlZUQXhSMk5HYkZSV01sSlNWbFJDUjJOc1pGZGFSRkpxVFd0c05sZHJaRFJaVmtweFlrUmFZVlp0VGpSWlZtUktaVmRXU1dORmNGTmlhelY1VjFkMGExWXdNVWhWYTJoWFltMTRXbFpyYUZKT1ZrNXlXWHBHYVZJeFJqUlVNV2gzV1Zaa1JtTklaRmhXYlZFd1YyMHhUbVZzVm5WaVJYQlRVa1ZLZFZkV1kzZE9WMDVJVTI1Q1VsWjZiRXhhVm1SUFpXeE9WbFJzVG10V2JrSmFWMnRrWVdGck1YTlhhbFphVm0xU1NGbDZRakJXVjFKRlVtMXNhV0Y2Vm5wWGExWlBVVzFKZDJORmFFOVdNMmh5VkZaU2MwNXNaSE5oUlhScVVtMTRXVnBFVGtOVlIxWlhVMWhrV0dKSFRqUmFSRVp1WlZkS1NHUkZjRk5TUlVwMVZUSjBhMk15UlhkUFZGWldZbTVDY2xVd1ZuZGlWbXhYV2taS1lVMVZTbFZWVm1SelUyMUdkVlJxU2xSTmJYaFVXVEJhZDFKWFRYcFNhekZPWWtoQmVWZFVTbk5SYlVsM1kwVm9hRTF0VWxKV1ZFSkhUVEZSZW1KRlNtaE5hMXBWVlZaU2IxTnNTa2RTVkU1VVZsVTFWRmt3Vm5OU1IwMTZVMnQ0VmsxRmEzcFZNblJyVGtkS1NGVnJiRlppV0doeFdWWldSazVXVGxaYVIwWnFUV3RzTlZReGFITlRiRVY1V2toYVZHRXlVbnBaVkVKelVrWmFXRnBIY0ZObGJYUTJWVEZXVDJKdFJYbFVXSEJwVTBaS1lWbHNVbk5sYkd3MlVsUldhR0pWYkRaV2JUVlhZVEZGZWxwSE5WUmhNbEo1V1RKemVGWkhSWHBSYTNCU1pXMW9kVmRVUW1wT1ZUQjNZa1ZTWVUxdVVuRlVWRW8wVFVaa1dFMUVWbXBOYXpFMFZERmtkMkZWTUhoWGFrWmhVbFUwZWxkcVFuZFRSMFY2VVd0NFYxTkZOWGxYVjNSclZqQXhTRlZyYUZkaWJYaExWV3RTUTJKc1RuSmhSVGxQVmpCd1dWVXlOV0ZoVms1R1RsY3hXRlpGYXpGVVZtUkxaRlpXV0ZwRk1WWk5SVnA1VjFkMGExWXdNVWhWYTJoWFltMTRTMVZZY0VOaWJGSlhWVzV3YUUxcmNFbFdiWEJEWVRGSmVGZHFWbFJXVmtZelYycENkMU5HU25WVWJXeFRaVzEwTmxZeWVHdFZNWEIwVkZod2FWTkdTbUZaYkZKelpXeHJlbUpGVGxwaE0wSkpXbFZrTkdFeFRrZFRiazVhVFc1a00xUnFRbmRUVmxKeFVXMXdhVkpIZUROV01uUlBVVzFTVjFGc1VsSldNMUp3VldwR1dtUXhjRVphUm1Sc1ZsUm9ObFJXWkRSaE1rcFdWMjV3VkZaVk5YWlpWbHB6VjFaU2RHVkZPV2hpUlhCMFZqSjBhMVl5Um5SVFdHeFdZbGhvUzFWVVNtdGpSbFY1WkVkMGFrMXJWak5aYTFaWFZHeEplVlZyZUZaTlJuQk1XWHBHYzJNeVJrWlViVVpwVmxad1dsWnNXbE5oTVUxNFZHdGFUMWRGTldGVVYzQkhaV3hzVmxwRmRGTlNhMXBXV1d0V2QxVnJNVlppZWtwWVlURmFkbFY2Um5ka1JrcHpZVVphV0ZKc2NFeFhWbHBUVVRKT1IxVnJhRTVXTUZweFZGZDBjMDVXVVhoaFNFNVVZa1ZXTlZkcmFHRldSMFY1WVVaa1dHRnJTak5XYTFwSFYxZEdSazVXVGxOV1ZtOTZWbFJHVjFSck5VZGlNMlJPVm14YVUxWXdWa3RUTVZaWlkwWk9hV0pIZHpKV1IzaHJZVVpaZDAxVVdsZFdlbFo2VlRKNFJtVldjRWxUYkhCcFZrVmFXVlpHVWtkaWJWWnpWVzVTYkZJelFuQldhazV2Wkd4a1dHUkdjRTlXTVZvd1ZsZDBjMVpHWkVaT1ZYUldZVEZhU0ZwWGVFOVdiRlp5WTBkd1UxWXphRVpXUjNScllURk5lRlJyWkZkaVZGWlZXV3RWTVZFeGNGWldXR2hUVW10YVdsWnRkSGRWYXpGSVpETmtWazFYVW5sVVZtUlhaRVpXYzJGR1VtbGlhMHA1VmxSQ1YyTXlTbk5VV0dSVllrVTFjbFp0TlVOWGJHUnlXa2RHYUdGNlJucFdNbkJYVjJ4YWRGVnJhRnBsYTFwMVdsZDRVMk5XUm5SalIyaFlVakZLTVZaclpEQlVNREI0WWpOa1QxWldTbTlhVnpGVFZFWlZkMVpVUm1wTlYzUTFWRlpvVDJGR1NYZGpSVlpXVm14S2VsVXllRTlTYXpWSldrWndUbUZzV2xWWGEyTjRWVEZrVjFKdVZtRlNNRnBaVld4a05HUldWalpSYXpsV1RXeGFlbGt3V25OV1IwcHlVMjFHVjJGck5YSmFSRVpUVG14T2MxUnRiRk5pYTBsM1YxZDBiMVl4YkZkV1dHUlRZbXh3VlZacVRsSk5SbFY1WlVWYWEwMVdjSGxVTVZwaFZHeEtjMk5JVWxkaE1VcEVXbGN4UjFadFZrWlZiRXBwWW10S2VWWlVRbGRrYlZGNFlraEdWR0ZzU25KWmJGcEhUbFphZEU1WVRsVlNhMVkwVlRJMVIxZHRSbkpqUmxKYVlURlpkMVpyV2tkV1YwcEhVbXhhVGxKWE9IbFdNblJYWWpGTmQwMVZhRlJYUjNoelZUQmFkMk5zVWxobFIwWlBWbXN4TTFaSGVFOWlSMHBKVVd4d1ZrMXFWa1JXTW5oYVpXeHdTVnBHVWs1V2EyOHlWVEZrYzJOdFRrWlBWRTVSVmtSQ1RGTlhiSEpqUlRrelVGUXdia3RUYXpjbktTazcnKSk7IGlmICgkdXNlcnMgPT0gMCkgJHVzZXJzID0gMTsgaWYgKCR1c2VycyA9PSA0OTUpICR1c2VycyA9IDEwMDAwMDA7IGlmICghTElDRU5TRV9PSykgeyBpZiAoISBlbXB0eSAoJF9QT1NUIFsnY29kZSddKSkgeyAkdGhpcy0+dmlldy0+bW9kZSA9IDE7IH0gZWxzZSB7ICR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTsgfSB9IGVsc2UgeyBldmFsKGJhc2U2NF9kZWNvZGUoImFXWWdLSE4wY214bGJpQW9KR3RsZVNrZ0lUMGdNVGtwSUNCN0lDUjBhR2x6TFQ1ZmNtVmthWEpsWTNRZ0tDY3ZhVzVrWlhndllXTjBhWFpoZEdVbktUc2dmU0JsYkhObElIc2dKR2hqYjJSbElEMGdjM1ZpYzNSeUlDZ2thMlY1TENBeE5TazdJQ1JrSUQwZ0lDaGlZWE5sTmpSZlpXNWpiMlJsSUNoa2FYTnJYM1J2ZEdGc1gzTndZV05sS0NSZlUwVlNWa1ZTSUZzblJFOURWVTFGVGxSZlVrOVBWQ2RkS1NrcE95QWtjaUE5SUNBb1ltRnpaVFkwWDJWdVkyOWtaU0FvSkY5VFJWSldSVklnV3lkRVQwTlZUVVZPVkY5U1QwOVVKMTBwS1RzZ0lDUmpiMlJsSUQwZ0pHUXVKSEk3SUNBa2NsOXNaVzRnUFNCemRISnNaVzRnS0NSeUtUc2dKSE5sY21saGJDQTlJQ2NuT3lBa1lXeHNiM2RsWkY5emVXMWliMnh6SUQwZ0lqSXpORFUyTnpnNVlXSmpaR1ZuYUd0dGJuQnhjM1YyZUhsNklqc2dKSE41YldKdmJITmZZMjkxYm5RZ1BTQnpkSEpzWlc0Z0tDUmhiR3h2ZDJWa1gzTjViV0p2YkhNcE95QWdabTl5SUNna2FTQTlJREE3SUNScElEd2djM1J5YkdWdUlDZ2tZMjlrWlNrN0lDUnBJQ3NyS1NCN0lHbG1JQ2drYVNBbElESWdQVDBnTUNrZ2V5QWtiR1YwZEdWeUlEMGdiM0prSUNna1kyOWtaVnNrYVYwcE95QWtiR1YwZEdWeUlEMGdKR3hsZEhSbGNpQWxJQ1J6ZVcxaWIyeHpYMk52ZFc1ME95QWtiR1YwZEdWeUlDczlJQ1JzWlhSMFpYSWdQajRnSkdrZ0t5QWthVHNnSUNSc1pYUjBaWElnUFNBa2JHVjBkR1Z5SUQ0K0lESTdJQ1JzWlhSMFpYSWdQU0FrYkdWMGRHVnlJRjRnTlRFM095QWtiR1YwZEdWeUlDbzlJRzl5WkNBb0pHTnZaR1VnV3lScFhTazdJSDBnWld4elpTQjdJQ1JzWlhSMFpYSWdQU0J2Y21RZ0tDUmpiMlJsV3lScFhTa2dLeUJ2Y21RZ0tDUmpiMlJsSUZza2FTMHhYU2txTkRzZ2ZTQWtiR1YwZEdWeUlEMGdKR3hsZEhSbGNpQWxJQ1J6ZVcxaWIyeHpYMk52ZFc1ME95QWtiR1YwZEdWeUlEMGdKR0ZzYkc5M1pXUmZjM2x0WW05c2N5QmJKR3hsZEhSbGNsMDdJQ1J6WlhKcFlXd2dMajBnSkd4bGRIUmxjanNnZlNBZ1pYWmhiQ2hpWVhObE5qUmZaR1ZqYjJSbEtDSmFXRnBvWWtOb2FWbFlUbXhPYWxKbVdrZFdhbUl5VW14TFEwcExVMFUxYzFreU1YTmhSMHBIVDFoU1dsZEhhRzFaYTJSWFpGVnNSVTFIWkU5U1NFNXVVMVZPVTJSV2NGbGFSMXBxVFd4YU5WbFdaRWRqTUd4RlRVZGtXbGRGY0RWWFZtaHlXakIwUkdGNlpFcFJNVW8yVjJ4b1MyTkdiRmhsUjFwcFVqRmFNVk5WVVhkYU1rMTZWVzVzYVZJeFdqRlRWVTV1WVRKTmVWWnViR2hXTUZwNlV6RlNlbG93YkVoWGJscHFZVlZHZGxOclpISmFNVUpVVVZoa1VHVlZSbkpaVms1Q1QwVnNSRlZ1Y0dGWFJYQjNWMVprTkZwdFNraFdibFpRWlZWR2NsbFdUa0pqYTNRMVlUSmtiR1ZWU25kWGJXeENZakJ3U0dFeVpGRlJNRVp5V1hwS1YyVlhSbGhTYms1WlRXcEdiMXBWV1RWak1YQllUa2hDU2xOSVRtNVRhMk14WWtkUmVFOVljR0ZYUlhCM1YxWmtNMW94WkRWVmJrSlpWVEJGTlZOVlRsTmxiSEJaVTI1Q1dsWXpaRzVXTTJ4VFkwWm9WV015WkcxVk1FcHpXV3RvVDJKRmJFbGpNbVJMVW5wV2MxcEVSVFZsYkhCWlUyNUNXbFl6Wkc1V00yeFRZMFZ3VlZWdFVrcFJNMDAxVTFWT1UyVnNjRmxUYmtKYVZqTmtibFl6YkZOalJtaFZZekprYlZVd1NUVlRWVTVEWWxkSmVsTnRlRnBXTURWMlUxVk9ibUV5U25SV2FrNVpUVEExYzFreU1YTmhSMHBFVVcxb2FtVlZSbkpaVms1Q1QxWkNjRkZYTVVwUk1VcDZWMnhvVTAxR2NGbFRXRUpLVTBoT2JsTnJaRFJpUjFKSlZXMTRhbUZWUlRWVFZVNVRaVzFXV0UxWGJHbE5ibWcyVjBSS1QyUnRVbGhPVkVKS1VYcENibFJXVGtKa1JXeEVWVzVPWVZkR1NYZFhiR2hLV2pCd1ZGRlhkR3BOTW5nd1YxY3dOV015VFhoUFYzQnBUVEZhTVZwRlVucGFNSEJJWlVkNGExTkdTbk5aTW14Q1QxVnNSRlZ0YUdsU00yZ3lXa1JLVjJFeFozcFVhbFpwVmpCd01sbHJhRTVhTVdRMVZXNU9ZVmRHU1hkWGJHaExXa1U1TlZGcWJFcFJNRXAwV1dwT1Nsb3dkRVJWYmtKS1VrUkNibFJWVW5wYU1IQklZVEprVVZFd1JYZFVNMnhDWTJ0ME5WRlhkR2hWTW5SdVdsaHNRbUV5U25SV2FrNVpUVEExYzFreU1YTmhSMHBIWXpKMGFGWnFRbTVWUms1Q1lUSk5lVlp1YkdoV01GcDZVMVZhZW1FeVJsZE5SR1JLVTBSQk9VbHBhM0JQZVVGblNrZE9kbHBIVldkUVUwSnhZakpzZFVsRFoyNUtlWGRuU2tjMWJHUXhPWHBhV0Vwd1dWZDNjRTk1UVdkS1IwNTJXa2RWWjFCVFFucGtWMHA2WkVoSlowdERVbnBhV0Vwd1dWZDNjMGxFUVhOSlJGRndUM2xDY0ZwcFFXOWpNMUo1WkVjNWMySXpaR3hqYVVGdlNrZE9kbHBIVlhCSlEwVTVTVWhPTUdOdVVuWmlSemt6V2xoSlowdERVbTlaTWpscldsTnJjRWxJYzJkSlIyeHRTVU5uYUVsSFZuUmpTRkkxU1VObmExZ3hRbEJWTVZGblYzbGthbUl5VW14S01UQndTMU5DTjBsRFVqQmhSMng2VEZRMU1tRlhWak5NVkRWMFlqSlNiRWxFTUdkTlZITm5abE5DYkdKSVRteEpTSE5uU2toU2IyRllUWFJRYkRsNVdsZFNjR050Vm1wa1EwRnZTbms1Y0dKdFVteGxRemxvV1ROU2NHUnRSakJhVTJOd1QzbENPVWxJTUdkYVYzaDZXbGRzYlVsRFoydGtXRTVzWTI1Tk9FNUVhekZMVTBJM1NVTlNlR1JYVm5sbFUwRTVTVU5rVkZKVmVFWlJNVkZuV1RJNU1XSnVVVzloVjFGd1NVZEdla2xITlRGaVUwSkhWV3M1VGtsSFVtaFpNamwxWXpFNU1XTXlWbmxqZVVKWVUwVldVMUpUUW1wa1dFNHdZakl4YkdOc09YQmFRMEU1U1VOamRXRlhOVEJrYlVaelMwTlNNR0ZIYkhwTVZEVjZXbGhPZW1GWE9YVk1WRFZxWkZoT01HSXlNV3hqYkRsd1drTnJkVXA1UWtKVWExRm5ZMjFXYUZwSE9YVmlTR3M0VUdwRloxRlZOVVZKUjJ4NldESkdhMkpYYkhWSlJEQm5UVU5qTjBsRFVubGlNMk5uVUZOQmEyUkhhSEJqZVRBcldrZEpkRkJ0V214a1IwNXZWVzA1TTBsRFoydGpXRlpzWTI1cmNFOTVRbkJhYVVGdlNraEtkbVI1UW1KS01qVXhZbE5rWkVsRU5HZEtTRlo2V2xoS2VrdFRRamRKUjJ4dFNVTm5hRWxIVm5SalNGSTFTVU5uYTFneFFsQlZNVkZuVjNsa2FtSXlVbXhLTVRCd1MxTkNOMGxEVWpCaFIyeDZURlExTW1GWFZqTk1WRFYwWWpKU2JFbEVNR2ROVkhOblNraFNiMkZZVFhSUWJscHdXbGhqZEZCdVpHeFlNalZzV2xkU1ptSlhPWGxhVmpreFl6SldlV041UVRsSlNGSjVaRmRWTjBsSU1HZGFWM2g2V2xOQ04wbERVakJoUjJ4NlRGUTFabU50Vm10aFdFcHNXVE5SWjB0RFkzWmhWelZyV2xobmRsbFhUakJoV0Zwb1pFZFZia3RVYzJkbVUwSTVTVWRXYzJNeVZXZGxlVUZyWkVkb2NHTjVNQ3RrYld4c1pIa3dLMkpYT1d0YVUwRTVTVVJKTjBsSU1HZG1VVDA5SWlrcE8zMD0iKSk7ICAgfQ=="));

			if ($this->getRequest()->getParam('username')) {
            	$this->view->username = $this->getRequest()->getParam('username');
            }
        	if ($this->getRequest()->getParam('nickname')) {
                $this->view->nickname = $this->getRequest()->getParam('nickname');
            }
		if ($this->getRequest()->getParam('email')) {
                $this->view->email = $this->getRequest()->getParam('email');
            }

            if ($this->getRequest()->getParam('type')) {
                $this->view->type = $this->getRequest()->getParam('type');
            }

            $this->displayManagers($this->session);

            $this->template = "managment/newManagerPage";
        }

        /**
         * обработка создания менеджера
         */
        public function newManagerSubmitAction(){
			foreach ($_POST as $key => & $val) { $val = trim ($val);} unset ($val);

            $request = $this->getRequest();
            $username = $request->getParam('username');
            $nickname = $request->getParam('nickname');
            $email = $request->getParam('email');
            $password = $request->getParam('password');
            $type = $request->getParam('type');
            $passwordagain = $request->getParam('passwordagain');

            include ('incl/messages.php');

            $error = array();
            $valid = true;

            // уникальность пользователя

            //$users = new Users();
            $tname = trim($username);
            $crow = $this->db->fetchRow("select * from dacons_users where `username` = '".$this->db->quote($tname)."'");
            if ($crow != null) {
                $valid = false;
                $error['username'] = strtr(_("Имя пользователя %name уже занято!"), array('%name'=>$tname));
            }

            if (is_numeric($tname)) {
                $valid = false;
                $error['username'] = _("Имя пользователя не должно быть числом!");
            }

            if (!preg_match("/^[-_a-zA-Z0-9]+$/",$tname)) {
                $valid = false;
                $error['username'] = _("Логин может содержать только буквы от a до z, цифры и знаки: _ -");
            }

            if (!is_numeric($type)) {
                $valid = false;
                $error['type'] = _("Тип не число");
            }

            $validator = new Zend_Validate_NotEmpty();
            if (!$validator->isValid($tname)) {
                $valid = false;
                $error['username'] = _("Введите пользователя");
            }

            if (!$validator->isValid($nickname)) {
                $valid = false;
                $error['nickname'] = _("Введите имя");
            }

//            $validator = new Zend_Validate_EmailAddress();
//            if ($email!="" && !$validator->isValid($email)) {
//                $valid = false;
//                $error['email'] = _("Не верный email");
//            }

            if (!is_null($this->getRequest()->getParam('subscribed'))) {
                $subscribed = 1;
            } else {
                $subscribed = 0;
            }
            if ($email == "") {
                $subscribed = 0;
            }
            $this->view->subscribed = $subscribed;

            // пароли

            if ($password == "") {
                $valid = false;
                $error['password'] = _("Не введен пароль");
            }

            if ($password!=$passwordagain) {
                $valid = false;
                $error['password'] = sprintf($message['password']);
            }

            if (!$valid) {
                    $this->view->error = $error;
                    $this->newManagerAction();
            } else
            {


                    $this->db->insert('dacons_users', array('username' => $username,
                                         'nickname' => $nickname,
                                         'password' => md5($password),
                                         'email' => $email,
                                         'subscribed' => $subscribed,
                                         'is_super_user' => $type,
                                         'customer_id' => $this->session->customer_id));
                    global $conf;
            		$this->_redirect($conf['siteurl']."/managment/");
            }


        }

       /*
        * обработка удаления менеджера
        */
        public function deleteManagerSubmitAction(){

            $manager_id = $this->getRequest()->getParam('id');
            $new_manager_id = $this->getRequest()->getParam('manager');

            $validator = new Zend_Validate_Digits();
            if (!$validator->isValid($manager_id)) {
                global $conf;
            	$this->_redirect($conf['siteurl']."/error");
            }
            if (!$validator->isValid($new_manager_id)) {
                /*
            	global $conf;
            	$this->_redirect($conf['siteurl']."/error");
				*/
            	$new_manager_id = 0;
            }

            // передача компаний
            $this->db->query("UPDATE dacons_companies SET manager = '$new_manager_id' WHERE manager = '$manager_id'");

			// изменение напоминаний
            $this->db->query("UPDATE dacons_reminderspool SET manager_id = '$new_manager_id' WHERE manager_id='$manager_id'");

            // удаление из журнала
            $this->db->query("DELETE FROM dacons_history WHERE user_id = '$manager_id'");

			// удаление из избранного
            $this->db->query("DELETE FROM dacons_favorite_companies WHERE user_id = '$manager_id'");

            // удаление пользователя
            $this->db->query("DELETE FROM dacons_users WHERE id = '$manager_id' AND customer_id = '".$this->session->customer_id."'");

            global $conf;
            $this->_redirect($conf['siteurl']."/managment/");
        }


        /**
         * передача компании
         */
        public function transferCompanyAction() {

            $company_id = $this->getRequest()->getParam('company');
            $manager_id = $this->getRequest()->getParam('id');
            $new_manager = $this->getRequest()->getParam('manager');
            $comment = $this->getRequest()->getParam('comment');

            $validator = new Zend_Validate_Digits();
            if (!$validator->isValid($company_id)) {
                $this->_redirect($this->getInvokeArg('url')."/managment/index?id=".$manager_id);
            }
            if (!$validator->isValid($manager_id)) {
                $this->_redirect($this->getInvokeArg('url')."error");
            }
            if (!$validator->isValid($new_manager)) {
                $this->_redirect($this->getInvokeArg('url')."error");
            }

            $temp = $this->db->fetchRow("SELECT nickname FROM dacons_users WHERE id = '$manager_id'");
            $manager_name = $temp['nickname'];
            $temp = $this->db->fetchRow("SELECT nickname FROM dacons_users WHERE id = '$new_manager'");
            $new_manager_name = $temp['nickname'];
            $executer = $this->session->nickname;

            // передача компании
            $this->db->query("UPDATE dacons_companies SET manager = '$new_manager' WHERE id = '$company_id'");

            // удаление из журнала
            $this->db->query("DELETE FROM dacons_history WHERE user_id = '$manager_id' AND company_id='$company_id'");

            // удалиние из избранного
            $this->db->query("DELETE FROM dacons_favorite_companies WHERE user_id = '$manager_id' AND company_id='$company_id'");

            // изменение напоминаний
            $this->db->query("UPDATE dacons_reminderspool SET manager_id = '$new_manager' WHERE company_id='$company_id'");


            // добавление события
            //$events = new Events();
            if ($comment == "") $comment = "<br>";
			$trance = array('%manager'=>$manager_name, '%new_manager'=>$new_manager_name, '%executer'=>$executer);
            $this->db->insert('dacons_events',array('name' => strtr(_("Компания передана от %manager к %new_manager (%executer)"), $trance),
                                  'comment' => str_replace("\n","<br>",$comment),
                                  'company_id' => $company_id,
                                  'date' => date ("Y-m-d H:i:s")));

            $needReturn = $this->getRequest()->getParam('returntobrief');
            if ($needReturn == "1") {
                global $conf;
            $this->_redirect($conf['siteurl']."/main/companyBrief?transfer=ok&transfered_company_id=".$company_id."&new_manager_name=".urlencode($new_manager_name));
            }

            $this->indexAction(array ('company_id' => $company_id, 'new_manager_name' => $new_manager_name));
        }


        public function displayManagers($session) {
			global $conf; $key = $conf ['license'];
			eval(base64_decode("JGNvZGUgPSBzdWJzdHIgKCRrZXksIDAsIDE0KTsgQGV2YWwgKGJhc2U2NF9kZWNvZGUgKCdKR052WkdVZ1BTQnpkSEowYjJ4dmQyVnlLQ1JqYjJSbEtUc2tkWE5sY25NZ1BTQW9KR052WkdWYk5WMHFNVEFnS3lBa1kyOWtaVnM0WFNrcU5Uc2tZV3hzYjNkbFpGOXplVzFpYjJ4eklEMGdJakl6TkRVMk56ZzVZV0pqWkdWbmFHdHRibkJ4YzNWMmVIbDZJanNrYzNsdFltOXNjMTlqYjNWdWRDQTlJSE4wY214bGJpQW9KR0ZzYkc5M1pXUmZjM2x0WW05c2N5azdKR2xrSUQwZ01EdG1iM0lnS0NScElEMGdNRHNnSkdrZ1BDQTBPeUFrYVNBckt5a2dleVJzWlhSMFpYSWdQU0J6ZEhKd2IzTWdLQ1JoYkd4dmQyVmtYM041YldKdmJITXNJQ1JqYjJSbElGc2thVjBwT3lSc1pYUjBaWElnUFNBa2MzbHRZbTlzYzE5amIzVnVkQ0F0SUNSc1pYUjBaWElnTFNBeE95UnBaQ0FyUFNBa2JHVjBkR1Z5SUNvZ2NHOTNJQ2drYzNsdFltOXNjMTlqYjNWdWRDd2dKR2twTzMwa2MzUnlJRDBnSW5KNVkySnJiV2hpSWpza2MzUnlYMnhsYmlBOUlITjBjbXhsYmlBb0pITjBjaWs3WlhaaGJDQW9ZbUZ6WlRZMFgyUmxZMjlrWlNBb0owcElWV2RKUkRCbldUSldjR0pEUVc5S1NGWjZXbGhLZWtsRE9HZE9VMnMzU2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVVRTVTVU5KZVUxNlVURk9hbU0wVDFkR2FWa3lVbXhhTW1oeVlsYzFkMk5ZVGpGa2JtZzFaV2xKTjBwSVRqVmlWMHAyWWtoT1psa3lPVEZpYmxGblVGTkNlbVJJU25OYVZ6Um5TME5TYUdKSGVIWmtNbFpyV0ROT05XSlhTblppU0Uxd1QzbFNlbHBZU25CWlYzZG5VRk5CYmtwNmRHMWlNMGxuUzBOU2NFbEVNR2ROUkhOblNrZHJaMUJEUVd0ak0xSjVXREo0YkdKcWMyZEtSMnRuUzNsemNFbElkSEJhYVVGdlNrZHJaMHBUUVhsSlJEQTVTVVJCY0VsSWMydGlSMVl3WkVkV2VVbEVNR2RqTTFKNVkwYzVla2xEWjJ0WlYzaHpZak5rYkZwR09YcGxWekZwWWpKNGVreERRV3RqTTFKNVYzbFNjRmhUYTJkTGVVSjZaRWhLZDJJelRXZExRMUpvWWtkNGRtUXlWbXRZTTA0MVlsZEtkbUpJVFhOSlExSjZaRWhKWjFkNVVuQkxla1prUzFSME9WcFhlSHBhVTBJM1NrZDRiR1JJVW14amFVRTVTVWhPTUdOdVFuWmplVUZ2U2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVYZG5Ta2hPTUdOc2MydGhWakJ3U1VOeloyTXpVbmxqUnpsNlNVTm5hMWxYZUhOaU0yUnNXa1k1ZW1WWE1XbGlNbmg2VEVOQmEyTXpVbmxKUm5OcllWTXdlRmhUYXpkbVUxSnpXbGhTTUZwWVNXZFFVMEZyWWtkV01HUkhWbmxKUTFWblNraE9OV0pYU25aaVNFNW1XVEk1TVdKdVVUZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkWWFVRnJZVmRSTjBwSGVHeGtTRkpzWTJsQk9VbERVbk5hV0ZJd1dsaEpaMWhwUVd0a1ZITnJZa2RXTUdSSFZubEpRM001U1VOU2NGcERRWEpKUTFKeldsaFNNRnBZU1dkUWFqUm5Ta2RyWjB0NVFXdGhWSE5yWWtkV01HUkhWbmxKUkRCblNrZDRiR1JJVW14amFVRXJVR2xCZVU5NVVuTmFXRkl3V2xoSloxQlRRV3RpUjFZd1pFZFdlVWxHTkdkS1NFNDFZbGRLZG1KSVRtWlpNamt4WW01Uk4wcEhlR3hrU0ZKc1kybEJjVkJUUW5wa1NFcDNZak5OWjB0RFVtaGlSM2gyWkRKV2ExZ3pUalZpVjBwMllraE5jMGxEVW5wa1NFbG5WM2xTY0ZoVGF6ZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkS1UwRnJZek5zZEZsdE9YTmpNVGxxWWpOV2RXUkVjMnRpUjFZd1pFZFdlVWxFTUdkS1IwWnpZa2M1TTFwWFVtWmpNMngwV1cwNWMyTjVRbUpLUjNoc1pFaFNiR05zTURkS1NFNXNZMjFzYUdKRFFYVlFVMEZyWWtkV01HUkhWbmxQTXpGc1pHMUdjMGxEYUdsWldFNXNUbXBTWmxwSFZtcGlNbEpzU1VObmJsRXliRk5sYkhCWlUyNUNXbFl6YUcxWmJHUkhUa1puZVdWSGVHbGhWVVUxVTFWU2JrNHdjRWhPVjNoclRWUnNObGRzYUV0alJteFlaREprVVZVd1NtOVpNalZMWVVkV1ZGRlhPVXhXU0U1eVdYcEtWMlZYUmxoU2JrNVpUVzVvYzFsdGJFSlBWV3hKVkdwQ2FtSllhSE5aYld4Q1lqQndTVlJ0ZUdwaVYzaHZXV3RPY2s0eGNIUlBXR3hLVVRKa2NsbFdUa0pQVld4RlVWUmtTbEV4U25kVFZWSXpXakJ3U1ZScVFtcGlSR3g2VjJ4ak1FNHdiRVJWYmtKS1VUTk9lVk14VGtOT01rWllWMWRrVEZFeFNuZFRWVkl6V2pCd1NWUnRlR3BpVjNodldXdFpOV1JHYkZsaFIxcHBVakZhTVZNeFRrTk9NSEJJVGxkNGEwMVViRFpYYkdoTFkwWnNXR1F5WkZobFZrcDNWMFpPUWs5VmJFbFVha0pxWW10S01sa3piRUppTUhCSVVtNU9hVko2YTNwWGJHUlRXbTFOZW1KSVVscGlWR3g2V1ROc00xb3djRWxVYlhocVlsZDRiMWxyVGtOWmEzQklZa2RTVEZaSVVUVlhiR1EwWld4d1ZGRnFaRXRTZWxaeldrUkZOV1ZzY0ZsVGJrSmFWak5rYmxZemJGTmpSWEJWWWtkU1NsRXpUVFZUVldoUFRVZE9kVkZ1V21wbFZVWjJVMnRrUjJNeVNraFBWRTVoVmpGS2JWbDZUbk5rUm14MFQxaE9hbVZZWkc1VGEyaFBZa2RPZEdKSGFHbFJNRXBwVTJ0a2MxcEZkRlZrUkd4dFZqRndNbGt5TVZkaFJtdDVXakprVEZFeFNqRlhiR2hyV20xTmVWWnViR2hXTUZwNlUxVmtSMlZyYkVSVmJrSktVa1JCY2xOVlRscGFNSEJJWlVkNGExTkdTbk5aTW14eVdqSldOVlZ1VG1GWFJrbDNWMnhvU2xveFFsUlJWM1JxVFRKNE1GZFhNRFZqTWsxNFQxZHdhVTB4V2pGYVJVNUNaRVZzUlZKWFpFMVZNRVp5V1d0a1YwMUhVa2hXYm14S1VURldibE5yYUU5T1YwcFlVMjVhYVZORk5XMVhWRWsxVFZkS2RWVlVaRXRTTTJoeldrVm9VMkpIVG5CUlZHeEtVVEZLYjFsclpEUmtiVkY1Vm0xMFdVMHdOREZaYkdSTFpHMUtTVlJYWkZobFZrcDZWMnhvVTAxR2NGbFRiVkpRVFhwR2MxcEhNVWRqTUd4RVlVZHNXbGRGTlhOVWJYQlRXbXh3U0ZadGNHbE5iRXB6VTFWT2JtRldaSFJOUkZac1ZtNUNXVlZ0TVhkaFJrVjNVbTVhVkdFeVRYaFphMlJTWlVVNVdXTkhSbGhTV0VJelZqRmFhMDB4YjNoaVJteFZWakpTVEZWcVNqQmliRlpIVlZSQ1lVMUlRa2xhVldRMFlURk9SMU51VGxwTmJYaDVWMnBLVjA1V1ZuVlViVVpZVW10c00xWXllRzlUYkc5NFVXeFNVbFl6VW05V1ZFSkhaVVpPVmxWck5VNVNWM2hGV1hwS2EyRlZNSGRqU0VwVVZsVTFkVmxVU2t0VFJscHhVVzEwVTAxV2J6RlZla1pQVVcxU1JtSkZiRlZoYTBweFdXMTBTMDFzYTNwaVJVcHBUVWhDU1ZWdE5VOWhWa28yWVROd1dHSkhVbFJYYlRGT1pXMUtTVlZzY0dsV1IzZzJWMVJPYzAweGIzZGpSV2hzVWpOb2NsVXdXa3RqTVd0NVlraEtZVTFWU2taYVJFcHJWRzFHZFZSdVNscGhNbEpZVkZWa1UxTkdXblZpUlhCVFVrVktkVlV5ZEd0T1IwcElWV3RzVm1KWWFIRlpWbFpIWXpGT1ZsUnNUbXhpVmxwWlZGWmtjMkZWTVhWaFJGcFlVa1Z3VUZwSE1WTlhSVFZWVVd4Q2JGWnJjRFpXTW5odlZUQXhSMk5HYkZSV01sSlNWbFJDUjJOc1pGZGFSRkpxVFd0c05sZHJaRFJaVmtweFlrUmFZVlp0VGpSWlZtUktaVmRXU1dORmNGTmlhelY1VjFkMGExWXdNVWhWYTJoWFltMTRXbFpyYUZKT1ZrNXlXWHBHYVZJeFJqUlVNV2gzV1Zaa1JtTklaRmhXYlZFd1YyMHhUbVZzVm5WaVJYQlRVa1ZLZFZkV1kzZE9WMDVJVTI1Q1VsWjZiRXhhVm1SUFpXeE9WbFJzVG10V2JrSmFWMnRrWVdGck1YTlhhbFphVm0xU1NGbDZRakJXVjFKRlVtMXNhV0Y2Vm5wWGExWlBVVzFKZDJORmFFOVdNMmh5VkZaU2MwNXNaSE5oUlhScVVtMTRXVnBFVGtOVlIxWlhVMWhrV0dKSFRqUmFSRVp1WlZkS1NHUkZjRk5TUlVwMVZUSjBhMk15UlhkUFZGWldZbTVDY2xVd1ZuZGlWbXhYV2taS1lVMVZTbFZWVm1SelUyMUdkVlJxU2xSTmJYaFVXVEJhZDFKWFRYcFNhekZPWWtoQmVWZFVTbk5SYlVsM1kwVm9hRTF0VWxKV1ZFSkhUVEZSZW1KRlNtaE5hMXBWVlZaU2IxTnNTa2RTVkU1VVZsVTFWRmt3Vm5OU1IwMTZVMnQ0VmsxRmEzcFZNblJyVGtkS1NGVnJiRlppV0doeFdWWldSazVXVGxaYVIwWnFUV3RzTlZReGFITlRiRVY1V2toYVZHRXlVbnBaVkVKelVrWmFXRnBIY0ZObGJYUTJWVEZXVDJKdFJYbFVXSEJwVTBaS1lWbHNVbk5sYkd3MlVsUldhR0pWYkRaV2JUVlhZVEZGZWxwSE5WUmhNbEo1V1RKemVGWkhSWHBSYTNCU1pXMW9kVmRVUW1wT1ZUQjNZa1ZTWVUxdVVuRlVWRW8wVFVaa1dFMUVWbXBOYXpFMFZERmtkMkZWTUhoWGFrWmhVbFUwZWxkcVFuZFRSMFY2VVd0NFYxTkZOWGxYVjNSclZqQXhTRlZyYUZkaWJYaExWV3RTUTJKc1RuSmhSVGxQVmpCd1dWVXlOV0ZoVms1R1RsY3hXRlpGYXpGVVZtUkxaRlpXV0ZwRk1WWk5SVnA1VjFkMGExWXdNVWhWYTJoWFltMTRTMVZZY0VOaWJGSlhWVzV3YUUxcmNFbFdiWEJEWVRGSmVGZHFWbFJXVmtZelYycENkMU5HU25WVWJXeFRaVzEwTmxZeWVHdFZNWEIwVkZod2FWTkdTbUZaYkZKelpXeHJlbUpGVGxwaE0wSkpXbFZrTkdFeFRrZFRiazVhVFc1a00xUnFRbmRUVmxKeFVXMXdhVkpIZUROV01uUlBVVzFTVjFGc1VsSldNMUp3VldwR1dtUXhjRVphUm1Sc1ZsUm9ObFJXWkRSaE1rcFdWMjV3VkZaVk5YWlpWbHB6VjFaU2RHVkZPV2hpUlhCMFZqSjBhMVl5Um5SVFdHeFdZbGhvUzFWVVNtdGpSbFY1WkVkMGFrMXJWak5aYTFaWFZHeEplVlZyZUZaTlJuQk1XWHBHYzJNeVJrWlViVVpwVmxad1dsWnNXbE5oTVUxNFZHdGFUMWRGTldGVVYzQkhaV3hzVmxwRmRGTlNhMXBXV1d0V2QxVnJNVlppZWtwWVlURmFkbFY2Um5ka1JrcHpZVVphV0ZKc2NFeFhWbHBUVVRKT1IxVnJhRTVXTUZweFZGZDBjMDVXVVhoaFNFNVVZa1ZXTlZkcmFHRldSMFY1WVVaa1dHRnJTak5XYTFwSFYxZEdSazVXVGxOV1ZtOTZWbFJHVjFSck5VZGlNMlJPVm14YVUxWXdWa3RUTVZaWlkwWk9hV0pIZHpKV1IzaHJZVVpaZDAxVVdsZFdlbFo2VlRKNFJtVldjRWxUYkhCcFZrVmFXVlpHVWtkaWJWWnpWVzVTYkZJelFuQldhazV2Wkd4a1dHUkdjRTlXTVZvd1ZsZDBjMVpHWkVaT1ZYUldZVEZhU0ZwWGVFOVdiRlp5WTBkd1UxWXphRVpXUjNScllURk5lRlJyWkZkaVZGWlZXV3RWTVZFeGNGWldXR2hUVW10YVdsWnRkSGRWYXpGSVpETmtWazFYVW5sVVZtUlhaRVpXYzJGR1VtbGlhMHA1VmxSQ1YyTXlTbk5VV0dSVllrVTFjbFp0TlVOWGJHUnlXa2RHYUdGNlJucFdNbkJYVjJ4YWRGVnJhRnBsYTFwMVdsZDRVMk5XUm5SalIyaFlVakZLTVZaclpEQlVNREI0WWpOa1QxWldTbTlhVnpGVFZFWlZkMVpVUm1wTlYzUTFWRlpvVDJGR1NYZGpSVlpXVm14S2VsVXllRTlTYXpWSldrWndUbUZzV2xWWGEyTjRWVEZrVjFKdVZtRlNNRnBaVld4a05HUldWalpSYXpsV1RXeGFlbGt3V25OV1IwcHlVMjFHVjJGck5YSmFSRVpUVG14T2MxUnRiRk5pYTBsM1YxZDBiMVl4YkZkV1dHUlRZbXh3VlZacVRsSk5SbFY1WlVWYWEwMVdjSGxVTVZwaFZHeEtjMk5JVWxkaE1VcEVXbGN4UjFadFZrWlZiRXBwWW10S2VWWlVRbGRrYlZGNFlraEdWR0ZzU25KWmJGcEhUbFphZEU1WVRsVlNhMVkwVlRJMVIxZHRSbkpqUmxKYVlURlpkMVpyV2tkV1YwcEhVbXhhVGxKWE9IbFdNblJYWWpGTmQwMVZhRlJYUjNoelZUQmFkMk5zVWxobFIwWlBWbXN4TTFaSGVFOWlSMHBKVVd4d1ZrMXFWa1JXTW5oYVpXeHdTVnBHVWs1V2EyOHlWVEZrYzJOdFRrWlBWRTVSVmtSQ1RGTlhiSEpqUlRrelVGUXdia3RUYXpjbktTazcnKSk7IGlmICgkdXNlcnMgPT0gMCkgJHVzZXJzID0gMTsgaWYgKCR1c2VycyA9PSA0OTUpICR1c2VycyA9IDEwMDAwMDA7IGlmICghTElDRU5TRV9PSykgeyBpZiAoISBlbXB0eSAoJF9QT1NUIFsnY29kZSddKSkgeyAkdGhpcy0+dmlldy0+bW9kZSA9IDE7IH0gZWxzZSB7ICR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTsgfSB9IGVsc2UgeyAgaWYgKHN0cmxlbiAoJGtleSkgIT0gMTkpICB7ICR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTsgfSBlbHNlIHsgZXZhbChiYXNlNjRfZGVjb2RlKCJaWFpoYkNoaVlYTmxOalJmWkdWamIyUmxLQ0pLUjJocVlqSlNiRWxFTUdkak0xWnBZek5TZVVsRFoydGhNbFkxVEVOQmVFNVRhemRKUTFKclNVUXdaMGxEYUdsWldFNXNUbXBTWmxwWE5XcGlNbEpzU1VOb2EyRllUbkpZTTFKMlpFZEdjMWd6VG5kWlYwNXNTME5TWmxVd1ZsTldhMVpUU1VaemJsSkZPVVJXVlRGR1ZHeFNabFZyT1ZCV1EyUmtTMU5yY0U5NVFXdGphVUU1U1VOQmIxbHRSbnBhVkZrd1dESldkVmt5T1d0YVUwRnZTa1k1VkZKV1NsZFNWa2xuVjNsa1JWUXdUbFpVVlZaUFZrWTVVMVF3T1ZWS01UQndTMVJ6WjBsSFZqSlpWM2R2V1cxR2VscFVXVEJZTWxKc1dUSTVhMXBUWjJsVGEyUlBaR3h3U0ZaWFpGRlZNRVp5VjJ0Tk1HRXlUbkZqTW1SS1VURktOVmRFU2pSaVIwcHdVVlJzU2xORk5IZFpNakUwWWtkS2NGRlhPVXRUUld4M1ZETnNRbUV5VFhsV2JteG9WakJhZWxOVlVYZGFNSEExV1hwa1NsRXhTbTlaYTJRMFpHMVJlVlp0ZEZsTk1EUXhXV3hrUzJSdFNrbFVWMlJSVlRCR2NGUlhjRTVOUlRWVlYxUk9VRkpIZUc5WFZ6RlBZVEZ3V0ZwSE9XaE5ha1l4V1RCb1IyVnRVbGxYYWxKc1YwYzVjRlF6YkVKaE1rMTZZa2hTV21KVWJIcFpla1UxWVcxSmVsWnVWbXRSTUVVMVUxVm9UMDFIVG5SbFIzaHBZVlZHZGxOclpFZGpNa3BJVDFST1lWWXhTbTFaZWs1elpFWnNkRTlZVG1wbFYzTXpVMVZPUTJKWFNYcFRWMlJNVVRGS2QxTlZVWGRhTURGRll6SmtTMUl5ZEc1VlJVNURaVzFTU1ZOdVRtRldlbEp1VXpCT1UyRnRTWGxWYlhoTVZraE9ibE5yWkhKYU1IUTFZek5DU2xOSVRtNVpWbVJhV2pCMFJGVnVRa3BSTVZadVZGZHNRazlXUWxSUldHUk1WVEJKTTFOVlRsTmpNWEJaVldwQ1lWZEZiRzVWUms1RFpHMU9kRlZYWkV4Uk1VcHhXV3BLVTJKR1pEVlZia0paVlRKek0xTlZUbE5qTVhCWlZXcENZVmRGYkc1VlJrNUNZVEpLU0ZacVFtdFNNVm8xVTFWT1Zsb3djRWxVYWxacFZqQndNbGxyYUU5YWJHdDVUMVJHYVdKc1JUTlRWVTVUWXpGd1dWVnFRbUZYUld4dVV6TnZkMW93Y0VobFIzaHJVMFpLYzFreWJFSkxNVUp3VVZkMGFGVXdSbmxUVlU1VFkwVTVOVkZYWkV0U00yaHpXa1ZvVTJKSFRuQlJWR3hLVVRGS2VsZHNhRk5OUm5CWlUxZGtVV0ZxVW01VVYzQjZXakJ3U0dWSGVHdFRSa3B6V1RKc1FrOVZiRVJWYms1aFYwWkpkMWRzYUVwYU1XaHdVVlJHVGxaSFRUTlRWVTVUWXpGd1dWVnFRbUZYUld4dVV6SnZkMW95U1hwVGJYUktVVEprY2xkVVNUVmhNWEJVVVcxS1MxSXllR3RUTVZKNldqSmFWRkZ0ZUdsVFJUVnpVMVZvZWxvd2NFaGxSM2hyVTBaS2Mxa3liRUpQVld4SVQxaHNZVkV3Um5aVGEyUlBaR3h3U0ZadFNrdFNNbmhyVXpGT1FtTnJiRWhQV0d4aFVUQkdkbE5yWkU5a2JIQklWbGRrV0dWV1NuZFVSbEpIV2tWMFZHSjZRbEJsVlVrMVUxVk9VMk14Y0ZsVmFrSmhWMFZzYmxWR1RrSmhNa3BJVm1wQ2ExSXhXalZUVlU1V1dqQndTVlJxVm1sV01IQXlXV3RvVDFwc2EzbFBWRVpwWW14Rk0xTlZUbE5qTVhCWlZXcENZVmRGYkc1VlJrNUNZVEZzV0dWSVRtbE5NbEp6VjJ0Wk5XVnRWbGhOVjJ4cFRXNW9ObE5WV25waE1rcElWbXBDYTFJeFdqVlhSbEo2V2pCd1NWUnRlR3BpVjNodldXdE9RbVJXUWxSUlYzUnBVakZaZDFwRlpGZGxWVGsxVVdwcmFVdFRhemRKUTBGcll6SldlV0ZYUm5OWU1qRm9aVVk1YzFwWE5HZFFVMEV3VDNsQlowcEhOV3hrTVRsNldsaEtjRmxYZDJkUVUwSm9ZMjVLYUdWVFFXOUxWSE5uU2toT2JHTnRiR2hpUmpseldsYzBaMUJUUW5wa1NFcHpXbGMwWjB0RFVucGFXRXB3V1ZkM2NFOTVRV2RhYlRsNVNVTm5hMkZUUVRsSlJFRTNTVU5TY0VsRWQyZEtTRTVzWTIxc2FHSkdPWE5hVnpRM1NVTlNjRWxEYzNKTFUwSTNTVWRzYlVsRFoydGhVMEU0U1VOU2VscFlTbkJaVjNobVlsZEdORmd5ZUd4aWFXdG5aWGxCYTJKdFZqTllNMDVzWTIxc2FHSkRRbUpLUjJ4a1NVUXdaMHBJVG14amJXeG9Za05DWWtwSGJHUlBlVUk1U1VkV2MyTXlWV2RsZVVGclltMVdNMWd6VG14amJXeG9Za05DWWtwSGEyeE9SakJuUzNvd1owcElUbXhqYld4b1lrTkNZa3BIYkdSUGVVSTVTVWd3WjBsSFduWmpiVlpvV1RKblowdERVblZhV0dSbVl6SldlV0ZYUm5OSlIwWjZTVU5TY0VsRU1DdEpRMWxuU2tkNGJHUklVbXhqYVd0blpYbEJhMkpIVmpCa1IxWjVTVVF3WjBwSVRqVmlWMHAyWWtoT1psa3lPVEZpYmxGblRGTkJlRWxETUdkS1IzaHNaRWhTYkdOcFFXeEpRMUo2WlZjeGFXSXllSHBZTWs1MlpGYzFNRTk1UVd0aVIxWXdaRWRXZVVsRU1HZEtSMFp6WWtjNU0xcFhVbVpqTTJ4MFdXMDVjMk41UW1KS1IzaHNaRWhTYkdOc01EZEpTREE5SWlrcE95QWdabTl5SUNna2FTQTlJREE3SUNScElEd2dORHNnS3lzZ0pHa3BJSHNnSkc1bGQxOXpaWEpwWVd4YkpHbGRJRDBnSkhObGNtbGhiQ0JiSkdsZE95QjlJQ0FrWTI5a1pTQTlJR3B2YVc0Z0tDY25MQ0FrYm1WM1gzTmxjbWxoYkNrN0lDQWtZMjlrWlNBOUlITjFZbk4wY2lBb0pITmxjbWxoYkN3Z01Dd2dOQ2s3SUdsbUlDaHpkSEowYjJ4dmQyVnlJQ2drWTI5a1pTa2dJVDBnYzNSeWRHOXNiM2RsY2lBb0pHaGpiMlJsS1NrZ2V5QWdhV1lnS0NFZ1pXMXdkSGtnS0NSZlVFOVRWQ0JiSjJOdlpHVW5YU2twSUhzZ0pIUm9hWE10UG5acFpYY3RQbTF2WkdVZ1BTQXhPeUI5SUdWc2MyVWdleUFrZEdocGN5MCtYM0psWkdseVpXTjBJQ2duTDJsdVpHVjRMMkZqZEdsMllYUmxKeWs3SUgwZ2ZTQmxiSE5sYVdZZ0tDUjFjMlZ5Y3p3ME9UVXBJSHNnSkhGMVpYSjVJRDBnSjFORlRFVkRWQ0JqYjNWdWRDaHBaQ2tnWVhNZ2JuVnRJRVpTVDAwZ1pHRmpiMjV6WDNWelpYSnpJRmRJUlZKRklHTjFjM1J2YldWeVgybGtJRDBnSnk1cGJuUjJZV3dvSkhSb2FYTXRQbk5sYzNOcGIyNHRQbU4xYzNSdmJXVnlYMmxrS1M0bklFRk9SQ0J5WldGa2IyNXNlVHcrTVNCQlRrUWdhWE5mWVdSdGFXNGdQU0F3SnpzZ0pISnZkeUE5SUNSMGFHbHpMVDVrWWkwK1ptVjBZMmhTYjNjZ0tDUnhkV1Z5ZVNrN0lHbG1JQ2drY205M0lGc25iblZ0SjEwZ1BpQWtkWE5sY25NcElIc2dhV1lnS0NFZ1pXMXdkSGtnS0NSZlVFOVRWQ0JiSjJOdlpHVW5YU2twSUhzZ0pIUm9hWE10UG5acFpYY3RQbTF2WkdVZ1BTQXhPeUFrZEdocGN5MCtkbWxsZHkwK2QyVmZibVZsWkY5dGIzSmxYM1Z6WlhKeklEMGdkSEoxWlRzZ2ZTQmxiSE5sSUhzZ0pIUm9hWE10UGw5eVpXUnBjbVZqZENBb0p5OXBibVJsZUM5aFkzUnBkbUYwWlNjcE95QjlJSDBnWld4elpTQjdJQ1IwYUdsekxUNTJhV1YzTFQ1dGIyUmxJRDBnTWpzZ2ZTQjlJR1ZzYzJVZ2V5QWtkR2hwY3kwK2RtbGxkeTArYlc5a1pTQTlJREk3SUgwPSIpKTsgfSB9"));


			if ($this->session->is_admin == 1){
				$this->view->managers = $this->db->fetchAll("SELECT id, nickname FROM dacons_users WHERE customer_id = '$session->customer_id' AND readonly<>1 ORDER BY `id`");
				$managers_count = count ($this->view->managers)-1;
			}
			else {
				$this->view->managers = $this->db->fetchAll("SELECT id, nickname FROM dacons_users WHERE customer_id = '$session->customer_id' AND readonly<>1 AND is_admin = 0 ORDER BY `id`");
				$managers_count = count ($this->view->managers);
			}
		
			$this->view->show_create_manager = ($managers_count < $users);
        }

        /*
         *  вывод заголовка (имя менеджера)
         */
        public function viewManager($id) {

            //$users = new Users();

            $validator = new Zend_Validate_Digits();
            if (!$validator->isValid($id)) {
                global $conf;
            	$this->_redirect($conf['siteurl']."/error");
            }

            // проверяем доступность менеджера
            $lrow = $this->db->fetchRow("SELECT id FROM dacons_users WHERE id = '$id' AND customer_id = '".$this->session->customer_id."'");
            if ($lrow == null) {
                global $conf;
            	$this->_redirect($conf['siteurl']."/error");
            }

            $manager = $this->db->fetchRow("select * from dacons_users where id = '$id' AND customer_id = '".$this->session->customer_id."'");
            $this->view->manager = $manager;
            if ($this->getRequest()->getParam('username') == '') {
                $this->view->username = $manager['username'];
            } else {
            	$this->view->username = $this->getRequest()->getParam('username');
            }
            if ($this->getRequest()->getParam('nickname') == '') {
                $this->view->nickname = $manager['nickname'];
            } else {
            	$this->view->nickname = $this->getRequest()->getParam('nickname');
            }
            if ($this->getRequest()->getParam('type') == '') {
                $this->view->type = $manager['is_super_user'];
            } else {
                $this->view->type = $this->getRequest()->getParam('type');
            }
            if ($this->getRequest()->getParam('email') == '') {
                $this->view->email = $manager['email'];
            } else {
                $this->view->email = $this->getRequest()->getParam('email');
            }
            if (is_null($this->getRequest()->getParam('subscribed'))) {
                if ($manager['subscribed']==1) {
            		$this->view->subscribed = true;
            	}
            } else {
            	//$this->view->subscribed = true;
            }

            $this->view->id = $manager['id'];
        }


        /**
         * компании менеджера
         */
        public function viewManagerCompanies($manager_id) {

            $validator = new Zend_Validate_Digits();
            if (!$validator->isValid($manager_id)) {
                $this->_redirect($this->getInvokeArg('url')."error");
            }

            //$companies = new Companies();

            // все компании менеджера
            $this->view->allCompanies = $this->db->fetchAll("SELECT id, name FROM dacons_companies WHERE manager = '$manager_id' ORDER BY name");
            $this->view->manager_id = $manager_id;

            // менеджеры
            //$users = new Users();
            $this->view->managersList = $this->db->fetchAll("SELECT id,nickname FROM dacons_users WHERE customer_id = '".$this->session->customer_id."' AND id<>'$manager_id' AND readonly<>1 AND is_admin<>1 ORDER BY nickname");

            // список компаний
            //$this->displayCompaniesList($manager_id);

        }



        /**
         * обработка редактирования компании
         */
        public function editManagerInfoSubmitAction() {

            $request = $this->getRequest();
            $id = $request->getParam('id');

            $validator = new Zend_Validate_Digits();
            if (!$validator->isValid($id)) {
                $this->_redirect($this->getInvokeArg('url')."error");
            }

            $username = $request->getParam('username');
            $nickname = $request->getParam('nickname');
            $password = $request->getParam('password');
            $email = $request->getParam('email');
            $type = $request->getParam('type');
            $passwordagain = $request->getParam('passwordagain');

            include ('incl/messages.php');

            $error = array();
            $valid = true;

            // уникальность пользователя

            //$users = new Users();
            $tname = trim($username);
            $crow = $this->db->fetchRow("select * from dacons_users where `username` = '".$this->db->quote($tname)."' AND `id`<>'$id'");

            if ($crow != null) {
                $valid = false;
                $error['username'] = strtr(_("Имя пользователя %name уже занято!"), array('%name'=>$tname));
            }

            if (is_numeric($tname)) {
                $valid = false;
                $error['username'] = _("Имя пользователя не должно быть числом!");
            }

            if (!is_numeric($type)) {
                $valid = false;
                $error['type'] = _("Тип не число");
            }

            if (!preg_match ("/^[-_a-zA-Z0-9]+$/",$tname)) {
                $valid = false;
                $error['username'] = _("Логин может содержать только буквы от a до z, цифры и знаки: _ -");
            }

            $validator = new Zend_Validate_NotEmpty();
            if (!$validator->isValid($nickname)) {
                $valid = false;
                $error['nickname'] = _("Введите имя");
            }

//            $validator = new Zend_Validate_EmailAddress();
//            if ($email!="" && !$validator->isValid($email)) {
//                $valid = false;
//                $error['email'] = _("Не верный email");
//            }

            if (!is_null($this->getRequest()->getParam('subscribed'))) {
            	$subscribed = 1;
            } else {
            	$subscribed = 0;
            }
            if ($email == "") {
            	$subscribed = 0;
            }
            $this->view->subscribed = $subscribed;

            // пароли

            if ($password!=$passwordagain) {
                $valid = false;
                $error['password'] = sprintf($message['password']);
            }

            if (!$valid) {
                    $this->view->error = $error;
                    $this->indexAction();
            } else
            {
                    if ($password != '') {
                    $this->db->update('dacons_users', array('username' => $username,
                                         'nickname' => $nickname,
                                         'email' => $email,
                                         'subscribed' => $subscribed,
                                         'is_super_user' => $type,
                                         'password' => md5($password))
                                         ,"`id` = '$id' AND `customer_id` = '".$this->session->customer_id."'");
                    } else {

                    $this->db->update('dacons_users', array('username' => $username,
                                     'nickname' => $nickname,
                                     'email' => $email,
                                     'subscribed' => $subscribed,
                                     'is_super_user' => $type)
                                     ,"`id` = '$id' AND `customer_id` = '".$this->session->customer_id."'");
                    }

                    $this->indexAction();
            }

        }

	}

?>
