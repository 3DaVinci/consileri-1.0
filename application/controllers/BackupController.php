<?php
/*
 * Создан: 08.11.2007 10:27:58
 * Автор: Александр Перов
 */

require_once 'Zend_Controller_ActionWithInit.php';
require_once 'Zend/Validate/Digits.php';
require_once 'Zend/Validate/NotEmpty.php';
require_once 'Zend/Validate/EmailAddress.php';




class BackupController extends Zend_Controller_ActionWithInit {

    public function preDispatch() {
        parent::preDispatch();
        if ($this->session->is_super_user == "") $this->_redirect("/index");
        global $is_demo, $is_saas;
        $this->view->is_demo = $is_demo;
		$this->view->is_saas = $is_saas;
        $this->view->doNotShowPDAlink = true;
        $this->trackPages();
    }

    public function indexAction() {
        $this->template = "backup/index";
        //<encoder_start>
        if (is_null($this->getRequest()->getParam('id'))) {
            $this->view->showInfo = true;
        }
        //global $conf; $key = $conf ['license'];@eval(base64_decode("JGNvZGUgPSBzdWJzdHIgKCRrZXksIDAsIDE0KTsgQGV2YWwgKGJhc2U2NF9kZWNvZGUgKCdKR052WkdVZ1BTQnpkSEowYjJ4dmQyVnlLQ1JqYjJSbEtUc2tkWE5sY25NZ1BTQW9KR052WkdWYk5WMHFNVEFnS3lBa1kyOWtaVnM0WFNrcU5Uc2tZV3hzYjNkbFpGOXplVzFpYjJ4eklEMGdJakl6TkRVMk56ZzVZV0pqWkdWbmFHdHRibkJ4YzNWMmVIbDZJanNrYzNsdFltOXNjMTlqYjNWdWRDQTlJSE4wY214bGJpQW9KR0ZzYkc5M1pXUmZjM2x0WW05c2N5azdKR2xrSUQwZ01EdG1iM0lnS0NScElEMGdNRHNnSkdrZ1BDQTBPeUFrYVNBckt5a2dleVJzWlhSMFpYSWdQU0J6ZEhKd2IzTWdLQ1JoYkd4dmQyVmtYM041YldKdmJITXNJQ1JqYjJSbElGc2thVjBwT3lSc1pYUjBaWElnUFNBa2MzbHRZbTlzYzE5amIzVnVkQ0F0SUNSc1pYUjBaWElnTFNBeE95UnBaQ0FyUFNBa2JHVjBkR1Z5SUNvZ2NHOTNJQ2drYzNsdFltOXNjMTlqYjNWdWRDd2dKR2twTzMwa2MzUnlJRDBnSW5KNVkySnJiV2hpSWpza2MzUnlYMnhsYmlBOUlITjBjbXhsYmlBb0pITjBjaWs3WlhaaGJDQW9ZbUZ6WlRZMFgyUmxZMjlrWlNBb0owcElWV2RKUkRCbldUSldjR0pEUVc5S1NGWjZXbGhLZWtsRE9HZE9VMnMzU2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVVRTVTVU5KZVUxNlVURk9hbU0wVDFkR2FWa3lVbXhhTW1oeVlsYzFkMk5ZVGpGa2JtZzFaV2xKTjBwSVRqVmlWMHAyWWtoT1psa3lPVEZpYmxGblVGTkNlbVJJU25OYVZ6Um5TME5TYUdKSGVIWmtNbFpyV0ROT05XSlhTblppU0Uxd1QzbFNlbHBZU25CWlYzZG5VRk5CYmtwNmRHMWlNMGxuUzBOU2NFbEVNR2ROUkhOblNrZHJaMUJEUVd0ak0xSjVXREo0YkdKcWMyZEtSMnRuUzNsemNFbElkSEJhYVVGdlNrZHJaMHBUUVhsSlJEQTVTVVJCY0VsSWMydGlSMVl3WkVkV2VVbEVNR2RqTTFKNVkwYzVla2xEWjJ0WlYzaHpZak5rYkZwR09YcGxWekZwWWpKNGVreERRV3RqTTFKNVYzbFNjRmhUYTJkTGVVSjZaRWhLZDJJelRXZExRMUpvWWtkNGRtUXlWbXRZTTA0MVlsZEtkbUpJVFhOSlExSjZaRWhKWjFkNVVuQkxla1prUzFSME9WcFhlSHBhVTBJM1NrZDRiR1JJVW14amFVRTVTVWhPTUdOdVFuWmplVUZ2U2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVYZG5Ta2hPTUdOc2MydGhWakJ3U1VOeloyTXpVbmxqUnpsNlNVTm5hMWxYZUhOaU0yUnNXa1k1ZW1WWE1XbGlNbmg2VEVOQmEyTXpVbmxKUm5OcllWTXdlRmhUYXpkbVUxSnpXbGhTTUZwWVNXZFFVMEZyWWtkV01HUkhWbmxKUTFWblNraE9OV0pYU25aaVNFNW1XVEk1TVdKdVVUZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkWWFVRnJZVmRSTjBwSGVHeGtTRkpzWTJsQk9VbERVbk5hV0ZJd1dsaEpaMWhwUVd0a1ZITnJZa2RXTUdSSFZubEpRM001U1VOU2NGcERRWEpKUTFKeldsaFNNRnBZU1dkUWFqUm5Ta2RyWjB0NVFXdGhWSE5yWWtkV01HUkhWbmxKUkRCblNrZDRiR1JJVW14amFVRXJVR2xCZVU5NVVuTmFXRkl3V2xoSloxQlRRV3RpUjFZd1pFZFdlVWxHTkdkS1NFNDFZbGRLZG1KSVRtWlpNamt4WW01Uk4wcEhlR3hrU0ZKc1kybEJjVkJUUW5wa1NFcDNZak5OWjB0RFVtaGlSM2gyWkRKV2ExZ3pUalZpVjBwMllraE5jMGxEVW5wa1NFbG5WM2xTY0ZoVGF6ZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkS1UwRnJZek5zZEZsdE9YTmpNVGxxWWpOV2RXUkVjMnRpUjFZd1pFZFdlVWxFTUdkS1IwWnpZa2M1TTFwWFVtWmpNMngwV1cwNWMyTjVRbUpLUjNoc1pFaFNiR05zTURkS1NFNXNZMjFzYUdKRFFYVlFVMEZyWWtkV01HUkhWbmxQTXpGc1pHMUdjMGxEYUdsWldFNXNUbXBTWmxwSFZtcGlNbEpzU1VObmJsRXliRk5sYkhCWlUyNUNXbFl6YUcxWmJHUkhUa1puZVdWSGVHbGhWVVUxVTFWU2JrNHdjRWhPVjNoclRWUnNObGRzYUV0alJteFlaREprVVZVd1NtOVpNalZMWVVkV1ZGRlhPVXhXU0U1eVdYcEtWMlZYUmxoU2JrNVpUVzVvYzFsdGJFSlBWV3hKVkdwQ2FtSllhSE5aYld4Q1lqQndTVlJ0ZUdwaVYzaHZXV3RPY2s0eGNIUlBXR3hLVVRKa2NsbFdUa0pQVld4RlVWUmtTbEV4U25kVFZWSXpXakJ3U1ZScVFtcGlSR3g2VjJ4ak1FNHdiRVJWYmtKS1VUTk9lVk14VGtOT01rWllWMWRrVEZFeFNuZFRWVkl6V2pCd1NWUnRlR3BpVjNodldXdFpOV1JHYkZsaFIxcHBVakZhTVZNeFRrTk9NSEJJVGxkNGEwMVViRFpYYkdoTFkwWnNXR1F5WkZobFZrcDNWMFpPUWs5VmJFbFVha0pxWW10S01sa3piRUppTUhCSVVtNU9hVko2YTNwWGJHUlRXbTFOZW1KSVVscGlWR3g2V1ROc00xb3djRWxVYlhocVlsZDRiMWxyVGtOWmEzQklZa2RTVEZaSVVUVlhiR1EwWld4d1ZGRnFaRXRTZWxaeldrUkZOV1ZzY0ZsVGJrSmFWak5rYmxZemJGTmpSWEJWWWtkU1NsRXpUVFZUVldoUFRVZE9kVkZ1V21wbFZVWjJVMnRrUjJNeVNraFBWRTVoVmpGS2JWbDZUbk5rUm14MFQxaE9hbVZZWkc1VGEyaFBZa2RPZEdKSGFHbFJNRXBwVTJ0a2MxcEZkRlZrUkd4dFZqRndNbGt5TVZkaFJtdDVXakprVEZFeFNqRlhiR2hyV20xTmVWWnViR2hXTUZwNlUxVmtSMlZyYkVSVmJrSktVa1JCY2xOVlRscGFNSEJJWlVkNGExTkdTbk5aTW14eVdqSldOVlZ1VG1GWFJrbDNWMnhvU2xveFFsUlJWM1JxVFRKNE1GZFhNRFZqTWsxNFQxZHdhVTB4V2pGYVJVNUNaRVZzUlZKWFpFMVZNRVp5V1d0a1YwMUhVa2hXYm14S1VURldibE5yYUU5T1YwcFlVMjVhYVZORk5XMVhWRWsxVFZkS2RWVlVaRXRTTTJoeldrVm9VMkpIVG5CUlZHeEtVVEZLYjFsclpEUmtiVkY1Vm0xMFdVMHdOREZaYkdSTFpHMUtTVlJYWkZobFZrcDZWMnhvVTAxR2NGbFRiVkpRVFhwR2MxcEhNVWRqTUd4RVlVZHNXbGRGTlhOVWJYQlRXbXh3U0ZadGNHbE5iRXB6VTFWT2JtRldaSFJOUkZac1ZtNUNXVlZ0TVhkaFJrVjNVbTVhVkdFeVRYaFphMlJTWlVVNVdXTkhSbGhTV0VJelZqRmFhMDB4YjNoaVJteFZWakpTVEZWcVNqQmliRlpIVlZSQ1lVMUlRa2xhVldRMFlURk9SMU51VGxwTmJYaDVWMnBLVjA1V1ZuVlViVVpZVW10c00xWXllRzlUYkc5NFVXeFNVbFl6VW05V1ZFSkhaVVpPVmxWck5VNVNWM2hGV1hwS2EyRlZNSGRqU0VwVVZsVTFkVmxVU2t0VFJscHhVVzEwVTAxV2J6RlZla1pQVVcxU1JtSkZiRlZoYTBweFdXMTBTMDFzYTNwaVJVcHBUVWhDU1ZWdE5VOWhWa28yWVROd1dHSkhVbFJYYlRGT1pXMUtTVlZzY0dsV1IzZzJWMVJPYzAweGIzZGpSV2hzVWpOb2NsVXdXa3RqTVd0NVlraEtZVTFWU2taYVJFcHJWRzFHZFZSdVNscGhNbEpZVkZWa1UxTkdXblZpUlhCVFVrVktkVlV5ZEd0T1IwcElWV3RzVm1KWWFIRlpWbFpIWXpGT1ZsUnNUbXhpVmxwWlZGWmtjMkZWTVhWaFJGcFlVa1Z3VUZwSE1WTlhSVFZWVVd4Q2JGWnJjRFpXTW5odlZUQXhSMk5HYkZSV01sSlNWbFJDUjJOc1pGZGFSRkpxVFd0c05sZHJaRFJaVmtweFlrUmFZVlp0VGpSWlZtUktaVmRXU1dORmNGTmlhelY1VjFkMGExWXdNVWhWYTJoWFltMTRXbFpyYUZKT1ZrNXlXWHBHYVZJeFJqUlVNV2gzV1Zaa1JtTklaRmhXYlZFd1YyMHhUbVZzVm5WaVJYQlRVa1ZLZFZkV1kzZE9WMDVJVTI1Q1VsWjZiRXhhVm1SUFpXeE9WbFJzVG10V2JrSmFWMnRrWVdGck1YTlhhbFphVm0xU1NGbDZRakJXVjFKRlVtMXNhV0Y2Vm5wWGExWlBVVzFKZDJORmFFOVdNMmh5VkZaU2MwNXNaSE5oUlhScVVtMTRXVnBFVGtOVlIxWlhVMWhrV0dKSFRqUmFSRVp1WlZkS1NHUkZjRk5TUlVwMVZUSjBhMk15UlhkUFZGWldZbTVDY2xVd1ZuZGlWbXhYV2taS1lVMVZTbFZWVm1SelUyMUdkVlJxU2xSTmJYaFVXVEJhZDFKWFRYcFNhekZPWWtoQmVWZFVTbk5SYlVsM1kwVm9hRTF0VWxKV1ZFSkhUVEZSZW1KRlNtaE5hMXBWVlZaU2IxTnNTa2RTVkU1VVZsVTFWRmt3Vm5OU1IwMTZVMnQ0VmsxRmEzcFZNblJyVGtkS1NGVnJiRlppV0doeFdWWldSazVXVGxaYVIwWnFUV3RzTlZReGFITlRiRVY1V2toYVZHRXlVbnBaVkVKelVrWmFXRnBIY0ZObGJYUTJWVEZXVDJKdFJYbFVXSEJwVTBaS1lWbHNVbk5sYkd3MlVsUldhR0pWYkRaV2JUVlhZVEZGZWxwSE5WUmhNbEo1V1RKemVGWkhSWHBSYTNCU1pXMW9kVmRVUW1wT1ZUQjNZa1ZTWVUxdVVuRlVWRW8wVFVaa1dFMUVWbXBOYXpFMFZERmtkMkZWTUhoWGFrWmhVbFUwZWxkcVFuZFRSMFY2VVd0NFYxTkZOWGxYVjNSclZqQXhTRlZyYUZkaWJYaExWV3RTUTJKc1RuSmhSVGxQVmpCd1dWVXlOV0ZoVms1R1RsY3hXRlpGYXpGVVZtUkxaRlpXV0ZwRk1WWk5SVnA1VjFkMGExWXdNVWhWYTJoWFltMTRTMVZZY0VOaWJGSlhWVzV3YUUxcmNFbFdiWEJEWVRGSmVGZHFWbFJXVmtZelYycENkMU5HU25WVWJXeFRaVzEwTmxZeWVHdFZNWEIwVkZod2FWTkdTbUZaYkZKelpXeHJlbUpGVGxwaE0wSkpXbFZrTkdFeFRrZFRiazVhVFc1a00xUnFRbmRUVmxKeFVXMXdhVkpIZUROV01uUlBVVzFTVjFGc1VsSldNMUp3VldwR1dtUXhjRVphUm1Sc1ZsUm9ObFJXWkRSaE1rcFdWMjV3VkZaVk5YWlpWbHB6VjFaU2RHVkZPV2hpUlhCMFZqSjBhMVl5Um5SVFdHeFdZbGhvUzFWVVNtdGpSbFY1WkVkMGFrMXJWak5aYTFaWFZHeEplVlZyZUZaTlJuQk1XWHBHYzJNeVJrWlViVVpwVmxad1dsWnNXbE5oTVUxNFZHdGFUMWRGTldGVVYzQkhaV3hzVmxwRmRGTlNhMXBXV1d0V2QxVnJNVlppZWtwWVlURmFkbFY2Um5ka1JrcHpZVVphV0ZKc2NFeFhWbHBUVVRKT1IxVnJhRTVXTUZweFZGZDBjMDVXVVhoaFNFNVVZa1ZXTlZkcmFHRldSMFY1WVVaa1dHRnJTak5XYTFwSFYxZEdSazVXVGxOV1ZtOTZWbFJHVjFSck5VZGlNMlJPVm14YVUxWXdWa3RUTVZaWlkwWk9hV0pIZHpKV1IzaHJZVVpaZDAxVVdsZFdlbFo2VlRKNFJtVldjRWxUYkhCcFZrVmFXVlpHVWtkaWJWWnpWVzVTYkZJelFuQldhazV2Wkd4a1dHUkdjRTlXTVZvd1ZsZDBjMVpHWkVaT1ZYUldZVEZhU0ZwWGVFOVdiRlp5WTBkd1UxWXphRVpXUjNScllURk5lRlJyWkZkaVZGWlZXV3RWTVZFeGNGWldXR2hUVW10YVdsWnRkSGRWYXpGSVpETmtWazFYVW5sVVZtUlhaRVpXYzJGR1VtbGlhMHA1VmxSQ1YyTXlTbk5VV0dSVllrVTFjbFp0TlVOWGJHUnlXa2RHYUdGNlJucFdNbkJYVjJ4YWRGVnJhRnBsYTFwMVdsZDRVMk5XUm5SalIyaFlVakZLTVZaclpEQlVNREI0WWpOa1QxWldTbTlhVnpGVFZFWlZkMVpVUm1wTlYzUTFWRlpvVDJGR1NYZGpSVlpXVm14S2VsVXllRTlTYXpWSldrWndUbUZzV2xWWGEyTjRWVEZrVjFKdVZtRlNNRnBaVld4a05HUldWalpSYXpsV1RXeGFlbGt3V25OV1IwcHlVMjFHVjJGck5YSmFSRVpUVG14T2MxUnRiRk5pYTBsM1YxZDBiMVl4YkZkV1dHUlRZbXh3VlZacVRsSk5SbFY1WlVWYWEwMVdjSGxVTVZwaFZHeEtjMk5JVWxkaE1VcEVXbGN4UjFadFZrWlZiRXBwWW10S2VWWlVRbGRrYlZGNFlraEdWR0ZzU25KWmJGcEhUbFphZEU1WVRsVlNhMVkwVlRJMVIxZHRSbkpqUmxKYVlURlpkMVpyV2tkV1YwcEhVbXhhVGxKWE9IbFdNblJYWWpGTmQwMVZhRlJYUjNoelZUQmFkMk5zVWxobFIwWlBWbXN4TTFaSGVFOWlSMHBKVVd4d1ZrMXFWa1JXTW5oYVpXeHdTVnBHVWs1V2EyOHlWVEZrYzJOdFRrWlBWRTVSVmtSQ1RGTlhiSEpqUlRrelVGUXdia3RUYXpjbktTazcnKSk7IGlmICgkdXNlcnMgPT0gMCkgJHVzZXJzID0gMTsgaWYgKCR1c2VycyA9PSA0OTUpICR1c2VycyA9IDEwMDAwMDA7IGlmICghTElDRU5TRV9PSykgeyBpZiAoISBlbXB0eSAoJF9QT1NUIFsnY29kZSddKSkgeyAkdGhpcy0+dmlldy0+bW9kZSA9IDE7IH0gZWxzZSB7ICR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTsgfSB9IGVsc2UgeyBldmFsKGJhc2U2NF9kZWNvZGUoImFXWWdLSE4wY214bGJpQW9KR3RsZVNrZ0lUMGdNVGtwSUNCN0lDUjBhR2x6TFQ1ZmNtVmthWEpsWTNRZ0tDY3ZhVzVrWlhndllXTjBhWFpoZEdVbktUc2dmU0JsYkhObElIc2dKR2hqYjJSbElEMGdjM1ZpYzNSeUlDZ2thMlY1TENBeE5TazdJQ1JrSUQwZ0lDaGlZWE5sTmpSZlpXNWpiMlJsSUNoa2FYTnJYM1J2ZEdGc1gzTndZV05sS0NSZlUwVlNWa1ZTSUZzblJFOURWVTFGVGxSZlVrOVBWQ2RkS1NrcE95QWtjaUE5SUNBb1ltRnpaVFkwWDJWdVkyOWtaU0FvSkY5VFJWSldSVklnV3lkRVQwTlZUVVZPVkY5U1QwOVVKMTBwS1RzZ0lDUmpiMlJsSUQwZ0pHUXVKSEk3SUNBa2NsOXNaVzRnUFNCemRISnNaVzRnS0NSeUtUc2dKSE5sY21saGJDQTlJQ2NuT3lBa1lXeHNiM2RsWkY5emVXMWliMnh6SUQwZ0lqSXpORFUyTnpnNVlXSmpaR1ZuYUd0dGJuQnhjM1YyZUhsNklqc2dKSE41YldKdmJITmZZMjkxYm5RZ1BTQnpkSEpzWlc0Z0tDUmhiR3h2ZDJWa1gzTjViV0p2YkhNcE95QWdabTl5SUNna2FTQTlJREE3SUNScElEd2djM1J5YkdWdUlDZ2tZMjlrWlNrN0lDUnBJQ3NyS1NCN0lHbG1JQ2drYVNBbElESWdQVDBnTUNrZ2V5QWtiR1YwZEdWeUlEMGdiM0prSUNna1kyOWtaVnNrYVYwcE95QWtiR1YwZEdWeUlEMGdKR3hsZEhSbGNpQWxJQ1J6ZVcxaWIyeHpYMk52ZFc1ME95QWtiR1YwZEdWeUlDczlJQ1JzWlhSMFpYSWdQajRnSkdrZ0t5QWthVHNnSUNSc1pYUjBaWElnUFNBa2JHVjBkR1Z5SUQ0K0lESTdJQ1JzWlhSMFpYSWdQU0FrYkdWMGRHVnlJRjRnTlRFM095QWtiR1YwZEdWeUlDbzlJRzl5WkNBb0pHTnZaR1VnV3lScFhTazdJSDBnWld4elpTQjdJQ1JzWlhSMFpYSWdQU0J2Y21RZ0tDUmpiMlJsV3lScFhTa2dLeUJ2Y21RZ0tDUmpiMlJsSUZza2FTMHhYU2txTkRzZ2ZTQWtiR1YwZEdWeUlEMGdKR3hsZEhSbGNpQWxJQ1J6ZVcxaWIyeHpYMk52ZFc1ME95QWtiR1YwZEdWeUlEMGdKR0ZzYkc5M1pXUmZjM2x0WW05c2N5QmJKR3hsZEhSbGNsMDdJQ1J6WlhKcFlXd2dMajBnSkd4bGRIUmxjanNnZlNBZ1pYWmhiQ2hpWVhObE5qUmZaR1ZqYjJSbEtDSmFXRnBvWWtOb2FWbFlUbXhPYWxKbVdrZFdhbUl5VW14TFEwcExVMFUxYzFreU1YTmhSMHBIVDFoU1dsZEhhRzFaYTJSWFpGVnNSVTFIWkU5U1NFNXVVMVZPVTJSV2NGbGFSMXBxVFd4YU5WbFdaRWRqTUd4RlRVZGtXbGRGY0RWWFZtaHlXakIwUkdGNlpFcFJNVW8yVjJ4b1MyTkdiRmhsUjFwcFVqRmFNVk5WVVhkYU1rMTZWVzVzYVZJeFdqRlRWVTV1WVRKTmVWWnViR2hXTUZwNlV6RlNlbG93YkVoWGJscHFZVlZHZGxOclpISmFNVUpVVVZoa1VHVlZSbkpaVms1Q1QwVnNSRlZ1Y0dGWFJYQjNWMVprTkZwdFNraFdibFpRWlZWR2NsbFdUa0pqYTNRMVlUSmtiR1ZWU25kWGJXeENZakJ3U0dFeVpGRlJNRVp5V1hwS1YyVlhSbGhTYms1WlRXcEdiMXBWV1RWak1YQllUa2hDU2xOSVRtNVRhMk14WWtkUmVFOVljR0ZYUlhCM1YxWmtNMW94WkRWVmJrSlpWVEJGTlZOVlRsTmxiSEJaVTI1Q1dsWXpaRzVXTTJ4VFkwWm9WV015WkcxVk1FcHpXV3RvVDJKRmJFbGpNbVJMVW5wV2MxcEVSVFZsYkhCWlUyNUNXbFl6Wkc1V00yeFRZMFZ3VlZWdFVrcFJNMDAxVTFWT1UyVnNjRmxUYmtKYVZqTmtibFl6YkZOalJtaFZZekprYlZVd1NUVlRWVTVEWWxkSmVsTnRlRnBXTURWMlUxVk9ibUV5U25SV2FrNVpUVEExYzFreU1YTmhSMHBFVVcxb2FtVlZSbkpaVms1Q1QxWkNjRkZYTVVwUk1VcDZWMnhvVTAxR2NGbFRXRUpLVTBoT2JsTnJaRFJpUjFKSlZXMTRhbUZWUlRWVFZVNVRaVzFXV0UxWGJHbE5ibWcyVjBSS1QyUnRVbGhPVkVKS1VYcENibFJXVGtKa1JXeEVWVzVPWVZkR1NYZFhiR2hLV2pCd1ZGRlhkR3BOTW5nd1YxY3dOV015VFhoUFYzQnBUVEZhTVZwRlVucGFNSEJJWlVkNGExTkdTbk5aTW14Q1QxVnNSRlZ0YUdsU00yZ3lXa1JLVjJFeFozcFVhbFpwVmpCd01sbHJhRTVhTVdRMVZXNU9ZVmRHU1hkWGJHaExXa1U1TlZGcWJFcFJNRXAwV1dwT1Nsb3dkRVJWYmtKS1VrUkNibFJWVW5wYU1IQklZVEprVVZFd1JYZFVNMnhDWTJ0ME5WRlhkR2hWTW5SdVdsaHNRbUV5U25SV2FrNVpUVEExYzFreU1YTmhSMHBIWXpKMGFGWnFRbTVWUms1Q1lUSk5lVlp1YkdoV01GcDZVMVZhZW1FeVJsZE5SR1JLVTBSQk9VbHBhM0JQZVVGblNrZE9kbHBIVldkUVUwSnhZakpzZFVsRFoyNUtlWGRuU2tjMWJHUXhPWHBhV0Vwd1dWZDNjRTk1UVdkS1IwNTJXa2RWWjFCVFFucGtWMHA2WkVoSlowdERVbnBhV0Vwd1dWZDNjMGxFUVhOSlJGRndUM2xDY0ZwcFFXOWpNMUo1WkVjNWMySXpaR3hqYVVGdlNrZE9kbHBIVlhCSlEwVTVTVWhPTUdOdVVuWmlSemt6V2xoSlowdERVbTlaTWpscldsTnJjRWxJYzJkSlIyeHRTVU5uYUVsSFZuUmpTRkkxU1VObmExZ3hRbEJWTVZGblYzbGthbUl5VW14S01UQndTMU5DTjBsRFVqQmhSMng2VEZRMU1tRlhWak5NVkRWMFlqSlNiRWxFTUdkTlZITm5abE5DYkdKSVRteEpTSE5uU2toU2IyRllUWFJRYkRsNVdsZFNjR050Vm1wa1EwRnZTbms1Y0dKdFVteGxRemxvV1ROU2NHUnRSakJhVTJOd1QzbENPVWxJTUdkYVYzaDZXbGRzYlVsRFoydGtXRTVzWTI1Tk9FNUVhekZMVTBJM1NVTlNlR1JYVm5sbFUwRTVTVU5rVkZKVmVFWlJNVkZuV1RJNU1XSnVVVzloVjFGd1NVZEdla2xITlRGaVUwSkhWV3M1VGtsSFVtaFpNamwxWXpFNU1XTXlWbmxqZVVKWVUwVldVMUpUUW1wa1dFNHdZakl4YkdOc09YQmFRMEU1U1VOamRXRlhOVEJrYlVaelMwTlNNR0ZIYkhwTVZEVjZXbGhPZW1GWE9YVk1WRFZxWkZoT01HSXlNV3hqYkRsd1drTnJkVXA1UWtKVWExRm5ZMjFXYUZwSE9YVmlTR3M0VUdwRloxRlZOVVZKUjJ4NldESkdhMkpYYkhWSlJEQm5UVU5qTjBsRFVubGlNMk5uVUZOQmEyUkhhSEJqZVRBcldrZEpkRkJ0V214a1IwNXZWVzA1TTBsRFoydGpXRlpzWTI1cmNFOTVRbkJhYVVGdlNraEtkbVI1UW1KS01qVXhZbE5rWkVsRU5HZEtTRlo2V2xoS2VrdFRRamRKUjJ4dFNVTm5hRWxIVm5SalNGSTFTVU5uYTFneFFsQlZNVkZuVjNsa2FtSXlVbXhLTVRCd1MxTkNOMGxEVWpCaFIyeDZURlExTW1GWFZqTk1WRFYwWWpKU2JFbEVNR2ROVkhOblNraFNiMkZZVFhSUWJscHdXbGhqZEZCdVpHeFlNalZzV2xkU1ptSlhPWGxhVmpreFl6SldlV041UVRsSlNGSjVaRmRWTjBsSU1HZGFWM2g2V2xOQ04wbERVakJoUjJ4NlRGUTFabU50Vm10aFdFcHNXVE5SWjB0RFkzWmhWelZyV2xobmRsbFhUakJoV0Zwb1pFZFZia3RVYzJkbVUwSTVTVWRXYzJNeVZXZGxlVUZyWkVkb2NHTjVNQ3RrYld4c1pIa3dLMkpYT1d0YVUwRTVTVVJKTjBsSU1HZG1VVDA5SWlrcE8zMD0iKSk7ICAgfQ=="));


        $id = $this->getRequest()->getParam("id");
        //<encoder_end>
        if (!is_numeric($id) || $id=="") {
            $temp = $this->db->fetchRow("SELECT id FROM dacons_users WHERE customer_id='".$this->session->customer_id."' LIMIT 1");
            $id = $temp["id"];
        }
        
    }

    public function sqlbackupAction() {
        global $is_saas;
		if (!(isset($is_saas) && ($is_saas==true))){
			$this->template = "backup/sqlbackup";
		} else {
			$this->_redirect("/index");
		}
    }

    public function sqlrestoreAction() {
		global $is_saas;
		if (!(isset($is_saas) && ($is_saas==true))){
			$this->template = "backup/sqlrestore";
		} else {
			$this->_redirect("/index");
		}
    }

    public function csvbackupAction() {
        global $conf;
        $path = str_replace ('http://'.$_SERVER['HTTP_HOST'], $_SERVER ['DOCUMENT_ROOT'], $conf['siteurl']).'/exportdata/';
        $this->view->csvfiles = $this->file_select($path);
        $this->template = "backup/exportcsv";
    }

    public function exportcsvgoAction() {
        if ($this->getRequest()->getParam("go")) {
            $createDate = time();
            require_once "functions.php";
            $filename = "exportdata/CONS_".date("Y-m-d_H-i",$createDate).".csv";
            $fp = fopen($filename,"w");
            $contents = getCSV ($this->db, $this->session);
            $contents = str_replace(";", "\t", $contents);
            $contents = iconv("UTF-8", "UTF-16LE", $contents);
            $contents = chr(hexdec('FF')) . chr(hexdec('FE')) . $contents;
            fwrite ($fp, $contents);
            fclose ($fp);
            $this->view->filename = $filename;
            $this->template = "backup/exportSuccess";
        } else {
            $this->csvbackupAction();
        }
    }

    function file_select($PATH) {
        $files = array();
        if (is_dir($PATH) && $handle = opendir($PATH)) {
            while (false !== ($file = readdir($handle))) {
                if (preg_match("/^.+?\.csv?$/", $file)) {
                    $files[$file] = '/exportdata/'.$file;
                }
            }
            closedir($handle);
        }
        krsort($files);
        return $files;
    }

    public function importexcelAction() {
        $this->view->managers = $this->db->fetchAll("SELECT id, nickname FROM dacons_users WHERE customer_id = '".$this->session->customer_id."' AND readonly<>1 AND is_admin = 0 ORDER BY `id`");
        global $locale_conf;
        $this->view->template_url = $locale_conf ['xls_template_url'];
        $this->template = "backup/excelImport";
    }

    public function importexcelgoAction() {
		global $conf;
        error_reporting(E_ALL &~E_NOTICE);
        $header_count = 2;
        if ($this->getRequest()->getParam("go")) {
            $this->template = "backup/excelImportGo";
            if (isset($_FILES['uploadfile']) && ($_FILES['uploadfile']['size']) && ($_FILES["uploadfile"]["type"] == "application/vnd.ms-excel")) {
                $this->session->excel_file=$_SERVER['DOCUMENT_ROOT'].$conf[dir]."/importdata/".md5 (basename($_FILES['uploadfile']['name']));
                $this->session->err = 0;
                $this->session->count_start = $header_count;
                $this->session->man_id = $_REQUEST['manager'];
				$this->session->added=0;
				$this->session->errorlog = '';
                copy($_FILES['uploadfile']['tmp_name'], $this->session->excel_file);
            } else if (!isset($this->session->excel_file)) {
                $this->importexcelAction();                
                return;
            }        

			require_once($_SERVER['DOCUMENT_ROOT'].$conf[dir].'/libs/excel_reader2.php');
			$xls = new Spreadsheet_Excel_Reader($this->session->excel_file, false);

			$total = $xls->rowcount();
			
			if ($this->session->man_id){        
	            $count_start = $header_count;
	            if (isset($this->session->count_start)) {$count_start = $this->session->count_start;}
	            $count_end = $count_start + 50;
	            if ($count_end > $total) {$count_end = $total;}

	            include ('incl/messages.php');
	            $count = $count_start + 1;			
	            for ($row = $count; $row <= $count_end; $row++) {
	                $valid = true;

	                $phone = array();
	                if ($xls->val($row, 'C')) array_push($phone, $xls->val($row, 'C'));
	                if ($xls->val($row, 'D')) array_push($phone, $xls->val($row, 'D'));
	                if ($xls->val($row, 'E')) array_push($phone, $xls->val($row, 'E'));
	                if ($xls->val($row, 'B')) array_push($phone, 'факс:'.$xls->val($row, 'B'));
	                
	                $address = array();
	                if ($xls->val($row, 'H')) array_push($address, $xls->val($row, 'H'));
	                if ($xls->val($row, 'I')) array_push($address, $xls->val($row, 'I'));
	                if ($xls->val($row, 'J')) array_push($address, $xls->val($row, 'J'));
	                if ($xls->val($row, 'K')) array_push($address, $xls->val($row, 'K'));

	                $name = $xls->val($row, 'A');
	                $phone = implode(", ", $phone);
	                $email = $xls->val($row, 'F');
	                $site = $xls->val($row, 'G');
	                $address = implode(", ", $address);
	                $about = $xls->val($row, 'L');

	                if ($name == "") {
	                    $valid = false;
	                }

	                $validator = new Zend_Validate_EmailAddress();
	                if ($email!="" && !$validator->isValid($email)) {
	                    $email="";
						$this->session->err+=1;
						$this->session->errorlog.=strtr(_("[Строка %row] Некорректный e-mail компании\n"), array ('%row' => $row));
	                }

	                if ($valid)
	                {
	                    $crow = $this->db->fetchRow("select * from dacons_companies where `name` = '".str_replace("'","\'",$name)."' AND `manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')");
	                    if ($crow != null) {
	                            $this->session->err+=1;
								$trance = array('%row'=>$row, '%name'=>$name);
								$this->session->errorlog.=strtr(_("[Строка %row] Компания \"%name\" уже существует\n"),$trance);
	                    } else {
	                        $company_id = $this->db->insert('dacons_companies', array('name' => $name,
	                                                                                   'site' => str_replace("http://","",$site),
	                                                                                   'email' => $email,
	                                                                                   'phone' => $phone,
	                                                                                   'address' => $address,
	                                                                                   'about' => $about,
	                                                                                   'manager' =>  $this->session->man_id));
							$this->session->added+=1;
	                        $peopleCount=10;
	                        $startCol = 13;
	                        $PersonColsCount=11;
							$personsData=array();
	                        for ($i = 0 ; $i < $peopleCount ; $i++) {
	                            $fc = $startCol + $PersonColsCount*$i;
	                            if ($xls->val($row, $fc)=='') break;
	                            $personsData[$i]['fio']=trim($xls->val($row, $fc).' '.$xls->val($row, $fc+1).' '.$xls->val($row, $fc+2));
	                            $personsData[$i]['phone']=trim($xls->val($row, $fc+4).' '.$xls->val($row, $fc+5).' '.$xls->val($row, $fc+6).' '.$xls->val($row, $fc+7));
								$personsData[$i]['email']=trim($xls->val($row, $fc+9));
	                            $validator = new Zend_Validate_EmailAddress();
				                if ($personsData[$i]['email']!="" && !$validator->isValid($personsData[$i]['email'])) {
				                    $personsData[$i]['email']="";
									$this->session->err+=1;
									$trance = array('%row'=>$row, '%name'=>$personsData[$i]['fio']);
									$this->session->errorlog.=strtr(_("[Строка %row] Некорректный e-mail контактного лица (%name)\n"),$trance);
				                }
	                            $personsData[$i]['comment']=trim(($xls->val($row, $fc+3)!=''?$xls->val($row, $fc+3):'').
	                                                        ($xls->val($row, $fc+8)!=''?', '._('день рождения').': '.$xls->val($row, $fc+8):''));
								$personsData[$i]['comment']=trim($personsData[$i]['comment'].($personsData[$i]['comment']!=''?', ':'').$xls->val($row, $fc+10));
	                        }

	                        foreach ($personsData as $k => $v) {
	                            $people_id = $this->db->insert('dacons_people', array('fio' => $v['fio'],
	                                                                                   'email' => $v['email'],
	                                                                                   'phone' => $v['phone'],
	                                                                                   'comment' => $v['comment']));
	                            $this->db->insert('dacons_people_company', array('person_id' => $people_id,
	                                                                            'company_id' => $company_id));

	                        }
	                    }
	                } else
	                    $this->session->err+=1;

	                $count++;
	            }
			} else {
				$this->session->err+=1;
				$this->session->errorlog .= _("Не определен менеджер, ведущий компании.\n");
				$count_end=$total;
			}

            if ($count_end < $total) {
                $this->session->count_start = $count_end;
				$trance=array('%from'=>($count_start + 1 - $header_count), '%to'=>($count_end - $header_count), '%all'=>($total-$header_count), '%count'=>$this->session->err);
                $this->view->message =
                    strtr(_("Внимание! Дождитесь завершения процесса, не закрывайте окно!<BR>
                     Обработаны строчки %from......%to (из %all всего)"), $trance)."<br>
                     ".($this->session->err?strtr(_("Ошибок в файле: %count"), $trance)." ":"")."
                    <SCRIPT LANGUAGE=\"JavaScript\">
                    idTimer=window.setTimeout(\"gotoLocation();\", ".($subscribe_interval * 1000).");
                    function gotoLocation() {
                            location=\"?go=finish\";
                            }
                    </SCRIPT>";
            } else {
                unlink($this->session->excel_file);
				unset($this->session->excel_file);
				if ($this->session->err!='') {
					$filename = "importdata/errorlog.txt";
		            $fp = fopen($filename,"w");
		            fwrite ($fp, $this->session->errorlog);
		            fclose ($fp);
				}
				$trance=array('%all'=>($total - $header_count), '%new'=>$this->session->added, '%err'=>$this->session->err);
                $this->view->message = strtr(_("Импорт завершён. Обработано %all строк. <br>".
                                        "Добавлено новых компаний: %new <br>"), $trance).
                                        ($this->session->err?strtr(_("Ошибок в файле: %err"), $trance)." <a target='_blank' href='".$conf['siteurl']."/importdata/errorlog.txt'>"._("Скачать лог ошибок.")."</a> <br>":"").
                                        _("Теперь можно закрыть окно.");				
            }
        } else {
           $this->importexcelAction(); 
        }
    }
}

?>
