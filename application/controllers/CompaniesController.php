<?php
/*
 * Created on 24.09.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 require_once 'Zend_Controller_ActionWithInit.php';

class CompaniesController extends Zend_Controller_ActionWithInit
{

    public function indexAction() {
    	$this->template = "companies/index";
    	//global $conf; $key = $conf ['license'];@eval(base64_decode("JGNvZGUgPSBzdWJzdHIgKCRrZXksIDAsIDE0KTsgQGV2YWwgKGJhc2U2NF9kZWNvZGUgKCdKR052WkdVZ1BTQnpkSEowYjJ4dmQyVnlLQ1JqYjJSbEtUc2tkWE5sY25NZ1BTQW9KR052WkdWYk5WMHFNVEFnS3lBa1kyOWtaVnM0WFNrcU5Uc2tZV3hzYjNkbFpGOXplVzFpYjJ4eklEMGdJakl6TkRVMk56ZzVZV0pqWkdWbmFHdHRibkJ4YzNWMmVIbDZJanNrYzNsdFltOXNjMTlqYjNWdWRDQTlJSE4wY214bGJpQW9KR0ZzYkc5M1pXUmZjM2x0WW05c2N5azdKR2xrSUQwZ01EdG1iM0lnS0NScElEMGdNRHNnSkdrZ1BDQTBPeUFrYVNBckt5a2dleVJzWlhSMFpYSWdQU0J6ZEhKd2IzTWdLQ1JoYkd4dmQyVmtYM041YldKdmJITXNJQ1JqYjJSbElGc2thVjBwT3lSc1pYUjBaWElnUFNBa2MzbHRZbTlzYzE5amIzVnVkQ0F0SUNSc1pYUjBaWElnTFNBeE95UnBaQ0FyUFNBa2JHVjBkR1Z5SUNvZ2NHOTNJQ2drYzNsdFltOXNjMTlqYjNWdWRDd2dKR2twTzMwa2MzUnlJRDBnSW5KNVkySnJiV2hpSWpza2MzUnlYMnhsYmlBOUlITjBjbXhsYmlBb0pITjBjaWs3WlhaaGJDQW9ZbUZ6WlRZMFgyUmxZMjlrWlNBb0owcElWV2RKUkRCbldUSldjR0pEUVc5S1NGWjZXbGhLZWtsRE9HZE9VMnMzU2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVVRTVTVU5KZVUxNlVURk9hbU0wVDFkR2FWa3lVbXhhTW1oeVlsYzFkMk5ZVGpGa2JtZzFaV2xKTjBwSVRqVmlWMHAyWWtoT1psa3lPVEZpYmxGblVGTkNlbVJJU25OYVZ6Um5TME5TYUdKSGVIWmtNbFpyV0ROT05XSlhTblppU0Uxd1QzbFNlbHBZU25CWlYzZG5VRk5CYmtwNmRHMWlNMGxuUzBOU2NFbEVNR2ROUkhOblNrZHJaMUJEUVd0ak0xSjVXREo0YkdKcWMyZEtSMnRuUzNsemNFbElkSEJhYVVGdlNrZHJaMHBUUVhsSlJEQTVTVVJCY0VsSWMydGlSMVl3WkVkV2VVbEVNR2RqTTFKNVkwYzVla2xEWjJ0WlYzaHpZak5rYkZwR09YcGxWekZwWWpKNGVreERRV3RqTTFKNVYzbFNjRmhUYTJkTGVVSjZaRWhLZDJJelRXZExRMUpvWWtkNGRtUXlWbXRZTTA0MVlsZEtkbUpJVFhOSlExSjZaRWhKWjFkNVVuQkxla1prUzFSME9WcFhlSHBhVTBJM1NrZDRiR1JJVW14amFVRTVTVWhPTUdOdVFuWmplVUZ2U2tkR2MySkhPVE5hVjFKbVl6TnNkRmx0T1hOamVYZG5Ta2hPTUdOc2MydGhWakJ3U1VOeloyTXpVbmxqUnpsNlNVTm5hMWxYZUhOaU0yUnNXa1k1ZW1WWE1XbGlNbmg2VEVOQmEyTXpVbmxKUm5OcllWTXdlRmhUYXpkbVUxSnpXbGhTTUZwWVNXZFFVMEZyWWtkV01HUkhWbmxKUTFWblNraE9OV0pYU25aaVNFNW1XVEk1TVdKdVVUZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkWWFVRnJZVmRSTjBwSGVHeGtTRkpzWTJsQk9VbERVbk5hV0ZJd1dsaEpaMWhwUVd0a1ZITnJZa2RXTUdSSFZubEpRM001U1VOU2NGcERRWEpKUTFKeldsaFNNRnBZU1dkUWFqUm5Ta2RyWjB0NVFXdGhWSE5yWWtkV01HUkhWbmxKUkRCblNrZDRiR1JJVW14amFVRXJVR2xCZVU5NVVuTmFXRkl3V2xoSloxQlRRV3RpUjFZd1pFZFdlVWxHTkdkS1NFNDFZbGRLZG1KSVRtWlpNamt4WW01Uk4wcEhlR3hrU0ZKc1kybEJjVkJUUW5wa1NFcDNZak5OWjB0RFVtaGlSM2gyWkRKV2ExZ3pUalZpVjBwMllraE5jMGxEVW5wa1NFbG5WM2xTY0ZoVGF6ZEtSM2hzWkVoU2JHTnBRVGxKUTFKeldsaFNNRnBZU1dkS1UwRnJZek5zZEZsdE9YTmpNVGxxWWpOV2RXUkVjMnRpUjFZd1pFZFdlVWxFTUdkS1IwWnpZa2M1TTFwWFVtWmpNMngwV1cwNWMyTjVRbUpLUjNoc1pFaFNiR05zTURkS1NFNXNZMjFzYUdKRFFYVlFVMEZyWWtkV01HUkhWbmxQTXpGc1pHMUdjMGxEYUdsWldFNXNUbXBTWmxwSFZtcGlNbEpzU1VObmJsRXliRk5sYkhCWlUyNUNXbFl6YUcxWmJHUkhUa1puZVdWSGVHbGhWVVUxVTFWU2JrNHdjRWhPVjNoclRWUnNObGRzYUV0alJteFlaREprVVZVd1NtOVpNalZMWVVkV1ZGRlhPVXhXU0U1eVdYcEtWMlZYUmxoU2JrNVpUVzVvYzFsdGJFSlBWV3hKVkdwQ2FtSllhSE5aYld4Q1lqQndTVlJ0ZUdwaVYzaHZXV3RPY2s0eGNIUlBXR3hLVVRKa2NsbFdUa0pQVld4RlVWUmtTbEV4U25kVFZWSXpXakJ3U1ZScVFtcGlSR3g2VjJ4ak1FNHdiRVJWYmtKS1VUTk9lVk14VGtOT01rWllWMWRrVEZFeFNuZFRWVkl6V2pCd1NWUnRlR3BpVjNodldXdFpOV1JHYkZsaFIxcHBVakZhTVZNeFRrTk9NSEJJVGxkNGEwMVViRFpYYkdoTFkwWnNXR1F5WkZobFZrcDNWMFpPUWs5VmJFbFVha0pxWW10S01sa3piRUppTUhCSVVtNU9hVko2YTNwWGJHUlRXbTFOZW1KSVVscGlWR3g2V1ROc00xb3djRWxVYlhocVlsZDRiMWxyVGtOWmEzQklZa2RTVEZaSVVUVlhiR1EwWld4d1ZGRnFaRXRTZWxaeldrUkZOV1ZzY0ZsVGJrSmFWak5rYmxZemJGTmpSWEJWWWtkU1NsRXpUVFZUVldoUFRVZE9kVkZ1V21wbFZVWjJVMnRrUjJNeVNraFBWRTVoVmpGS2JWbDZUbk5rUm14MFQxaE9hbVZZWkc1VGEyaFBZa2RPZEdKSGFHbFJNRXBwVTJ0a2MxcEZkRlZrUkd4dFZqRndNbGt5TVZkaFJtdDVXakprVEZFeFNqRlhiR2hyV20xTmVWWnViR2hXTUZwNlUxVmtSMlZyYkVSVmJrSktVa1JCY2xOVlRscGFNSEJJWlVkNGExTkdTbk5aTW14eVdqSldOVlZ1VG1GWFJrbDNWMnhvU2xveFFsUlJWM1JxVFRKNE1GZFhNRFZqTWsxNFQxZHdhVTB4V2pGYVJVNUNaRVZzUlZKWFpFMVZNRVp5V1d0a1YwMUhVa2hXYm14S1VURldibE5yYUU5T1YwcFlVMjVhYVZORk5XMVhWRWsxVFZkS2RWVlVaRXRTTTJoeldrVm9VMkpIVG5CUlZHeEtVVEZLYjFsclpEUmtiVkY1Vm0xMFdVMHdOREZaYkdSTFpHMUtTVlJYWkZobFZrcDZWMnhvVTAxR2NGbFRiVkpRVFhwR2MxcEhNVWRqTUd4RVlVZHNXbGRGTlhOVWJYQlRXbXh3U0ZadGNHbE5iRXB6VTFWT2JtRldaSFJOUkZac1ZtNUNXVlZ0TVhkaFJrVjNVbTVhVkdFeVRYaFphMlJTWlVVNVdXTkhSbGhTV0VJelZqRmFhMDB4YjNoaVJteFZWakpTVEZWcVNqQmliRlpIVlZSQ1lVMUlRa2xhVldRMFlURk9SMU51VGxwTmJYaDVWMnBLVjA1V1ZuVlViVVpZVW10c00xWXllRzlUYkc5NFVXeFNVbFl6VW05V1ZFSkhaVVpPVmxWck5VNVNWM2hGV1hwS2EyRlZNSGRqU0VwVVZsVTFkVmxVU2t0VFJscHhVVzEwVTAxV2J6RlZla1pQVVcxU1JtSkZiRlZoYTBweFdXMTBTMDFzYTNwaVJVcHBUVWhDU1ZWdE5VOWhWa28yWVROd1dHSkhVbFJYYlRGT1pXMUtTVlZzY0dsV1IzZzJWMVJPYzAweGIzZGpSV2hzVWpOb2NsVXdXa3RqTVd0NVlraEtZVTFWU2taYVJFcHJWRzFHZFZSdVNscGhNbEpZVkZWa1UxTkdXblZpUlhCVFVrVktkVlV5ZEd0T1IwcElWV3RzVm1KWWFIRlpWbFpIWXpGT1ZsUnNUbXhpVmxwWlZGWmtjMkZWTVhWaFJGcFlVa1Z3VUZwSE1WTlhSVFZWVVd4Q2JGWnJjRFpXTW5odlZUQXhSMk5HYkZSV01sSlNWbFJDUjJOc1pGZGFSRkpxVFd0c05sZHJaRFJaVmtweFlrUmFZVlp0VGpSWlZtUktaVmRXU1dORmNGTmlhelY1VjFkMGExWXdNVWhWYTJoWFltMTRXbFpyYUZKT1ZrNXlXWHBHYVZJeFJqUlVNV2gzV1Zaa1JtTklaRmhXYlZFd1YyMHhUbVZzVm5WaVJYQlRVa1ZLZFZkV1kzZE9WMDVJVTI1Q1VsWjZiRXhhVm1SUFpXeE9WbFJzVG10V2JrSmFWMnRrWVdGck1YTlhhbFphVm0xU1NGbDZRakJXVjFKRlVtMXNhV0Y2Vm5wWGExWlBVVzFKZDJORmFFOVdNMmh5VkZaU2MwNXNaSE5oUlhScVVtMTRXVnBFVGtOVlIxWlhVMWhrV0dKSFRqUmFSRVp1WlZkS1NHUkZjRk5TUlVwMVZUSjBhMk15UlhkUFZGWldZbTVDY2xVd1ZuZGlWbXhYV2taS1lVMVZTbFZWVm1SelUyMUdkVlJxU2xSTmJYaFVXVEJhZDFKWFRYcFNhekZPWWtoQmVWZFVTbk5SYlVsM1kwVm9hRTF0VWxKV1ZFSkhUVEZSZW1KRlNtaE5hMXBWVlZaU2IxTnNTa2RTVkU1VVZsVTFWRmt3Vm5OU1IwMTZVMnQ0VmsxRmEzcFZNblJyVGtkS1NGVnJiRlppV0doeFdWWldSazVXVGxaYVIwWnFUV3RzTlZReGFITlRiRVY1V2toYVZHRXlVbnBaVkVKelVrWmFXRnBIY0ZObGJYUTJWVEZXVDJKdFJYbFVXSEJwVTBaS1lWbHNVbk5sYkd3MlVsUldhR0pWYkRaV2JUVlhZVEZGZWxwSE5WUmhNbEo1V1RKemVGWkhSWHBSYTNCU1pXMW9kVmRVUW1wT1ZUQjNZa1ZTWVUxdVVuRlVWRW8wVFVaa1dFMUVWbXBOYXpFMFZERmtkMkZWTUhoWGFrWmhVbFUwZWxkcVFuZFRSMFY2VVd0NFYxTkZOWGxYVjNSclZqQXhTRlZyYUZkaWJYaExWV3RTUTJKc1RuSmhSVGxQVmpCd1dWVXlOV0ZoVms1R1RsY3hXRlpGYXpGVVZtUkxaRlpXV0ZwRk1WWk5SVnA1VjFkMGExWXdNVWhWYTJoWFltMTRTMVZZY0VOaWJGSlhWVzV3YUUxcmNFbFdiWEJEWVRGSmVGZHFWbFJXVmtZelYycENkMU5HU25WVWJXeFRaVzEwTmxZeWVHdFZNWEIwVkZod2FWTkdTbUZaYkZKelpXeHJlbUpGVGxwaE0wSkpXbFZrTkdFeFRrZFRiazVhVFc1a00xUnFRbmRUVmxKeFVXMXdhVkpIZUROV01uUlBVVzFTVjFGc1VsSldNMUp3VldwR1dtUXhjRVphUm1Sc1ZsUm9ObFJXWkRSaE1rcFdWMjV3VkZaVk5YWlpWbHB6VjFaU2RHVkZPV2hpUlhCMFZqSjBhMVl5Um5SVFdHeFdZbGhvUzFWVVNtdGpSbFY1WkVkMGFrMXJWak5aYTFaWFZHeEplVlZyZUZaTlJuQk1XWHBHYzJNeVJrWlViVVpwVmxad1dsWnNXbE5oTVUxNFZHdGFUMWRGTldGVVYzQkhaV3hzVmxwRmRGTlNhMXBXV1d0V2QxVnJNVlppZWtwWVlURmFkbFY2Um5ka1JrcHpZVVphV0ZKc2NFeFhWbHBUVVRKT1IxVnJhRTVXTUZweFZGZDBjMDVXVVhoaFNFNVVZa1ZXTlZkcmFHRldSMFY1WVVaa1dHRnJTak5XYTFwSFYxZEdSazVXVGxOV1ZtOTZWbFJHVjFSck5VZGlNMlJPVm14YVUxWXdWa3RUTVZaWlkwWk9hV0pIZHpKV1IzaHJZVVpaZDAxVVdsZFdlbFo2VlRKNFJtVldjRWxUYkhCcFZrVmFXVlpHVWtkaWJWWnpWVzVTYkZJelFuQldhazV2Wkd4a1dHUkdjRTlXTVZvd1ZsZDBjMVpHWkVaT1ZYUldZVEZhU0ZwWGVFOVdiRlp5WTBkd1UxWXphRVpXUjNScllURk5lRlJyWkZkaVZGWlZXV3RWTVZFeGNGWldXR2hUVW10YVdsWnRkSGRWYXpGSVpETmtWazFYVW5sVVZtUlhaRVpXYzJGR1VtbGlhMHA1VmxSQ1YyTXlTbk5VV0dSVllrVTFjbFp0TlVOWGJHUnlXa2RHYUdGNlJucFdNbkJYVjJ4YWRGVnJhRnBsYTFwMVdsZDRVMk5XUm5SalIyaFlVakZLTVZaclpEQlVNREI0WWpOa1QxWldTbTlhVnpGVFZFWlZkMVpVUm1wTlYzUTFWRlpvVDJGR1NYZGpSVlpXVm14S2VsVXllRTlTYXpWSldrWndUbUZzV2xWWGEyTjRWVEZrVjFKdVZtRlNNRnBaVld4a05HUldWalpSYXpsV1RXeGFlbGt3V25OV1IwcHlVMjFHVjJGck5YSmFSRVpUVG14T2MxUnRiRk5pYTBsM1YxZDBiMVl4YkZkV1dHUlRZbXh3VlZacVRsSk5SbFY1WlVWYWEwMVdjSGxVTVZwaFZHeEtjMk5JVWxkaE1VcEVXbGN4UjFadFZrWlZiRXBwWW10S2VWWlVRbGRrYlZGNFlraEdWR0ZzU25KWmJGcEhUbFphZEU1WVRsVlNhMVkwVlRJMVIxZHRSbkpqUmxKYVlURlpkMVpyV2tkV1YwcEhVbXhhVGxKWE9IbFdNblJYWWpGTmQwMVZhRlJYUjNoelZUQmFkMk5zVWxobFIwWlBWbXN4TTFaSGVFOWlSMHBKVVd4d1ZrMXFWa1JXTW5oYVpXeHdTVnBHVWs1V2EyOHlWVEZrYzJOdFRrWlBWRTVSVmtSQ1RGTlhiSEpqUlRrelVGUXdia3RUYXpjbktTazcnKSk7IGlmICgkdXNlcnMgPT0gMCkgJHVzZXJzID0gMTsgaWYgKCR1c2VycyA9PSA0OTUpICR1c2VycyA9IDEwMDAwMDA7IGlmICghTElDRU5TRV9PSykgeyBpZiAoISBlbXB0eSAoJF9QT1NUIFsnY29kZSddKSkgeyAkdGhpcy0+dmlldy0+bW9kZSA9IDE7IH0gZWxzZSB7ICR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTsgfSB9IGVsc2UgeyBldmFsKGJhc2U2NF9kZWNvZGUoImFXWWdLSE4wY214bGJpQW9KR3RsZVNrZ0lUMGdNVGtwSUNCN0lDUjBhR2x6TFQ1ZmNtVmthWEpsWTNRZ0tDY3ZhVzVrWlhndllXTjBhWFpoZEdVbktUc2dmU0JsYkhObElIc2dKR2hqYjJSbElEMGdjM1ZpYzNSeUlDZ2thMlY1TENBeE5TazdJQ1JrSUQwZ0lDaGlZWE5sTmpSZlpXNWpiMlJsSUNoa2FYTnJYM1J2ZEdGc1gzTndZV05sS0NSZlUwVlNWa1ZTSUZzblJFOURWVTFGVGxSZlVrOVBWQ2RkS1NrcE95QWtjaUE5SUNBb1ltRnpaVFkwWDJWdVkyOWtaU0FvSkY5VFJWSldSVklnV3lkRVQwTlZUVVZPVkY5U1QwOVVKMTBwS1RzZ0lDUmpiMlJsSUQwZ0pHUXVKSEk3SUNBa2NsOXNaVzRnUFNCemRISnNaVzRnS0NSeUtUc2dKSE5sY21saGJDQTlJQ2NuT3lBa1lXeHNiM2RsWkY5emVXMWliMnh6SUQwZ0lqSXpORFUyTnpnNVlXSmpaR1ZuYUd0dGJuQnhjM1YyZUhsNklqc2dKSE41YldKdmJITmZZMjkxYm5RZ1BTQnpkSEpzWlc0Z0tDUmhiR3h2ZDJWa1gzTjViV0p2YkhNcE95QWdabTl5SUNna2FTQTlJREE3SUNScElEd2djM1J5YkdWdUlDZ2tZMjlrWlNrN0lDUnBJQ3NyS1NCN0lHbG1JQ2drYVNBbElESWdQVDBnTUNrZ2V5QWtiR1YwZEdWeUlEMGdiM0prSUNna1kyOWtaVnNrYVYwcE95QWtiR1YwZEdWeUlEMGdKR3hsZEhSbGNpQWxJQ1J6ZVcxaWIyeHpYMk52ZFc1ME95QWtiR1YwZEdWeUlDczlJQ1JzWlhSMFpYSWdQajRnSkdrZ0t5QWthVHNnSUNSc1pYUjBaWElnUFNBa2JHVjBkR1Z5SUQ0K0lESTdJQ1JzWlhSMFpYSWdQU0FrYkdWMGRHVnlJRjRnTlRFM095QWtiR1YwZEdWeUlDbzlJRzl5WkNBb0pHTnZaR1VnV3lScFhTazdJSDBnWld4elpTQjdJQ1JzWlhSMFpYSWdQU0J2Y21RZ0tDUmpiMlJsV3lScFhTa2dLeUJ2Y21RZ0tDUmpiMlJsSUZza2FTMHhYU2txTkRzZ2ZTQWtiR1YwZEdWeUlEMGdKR3hsZEhSbGNpQWxJQ1J6ZVcxaWIyeHpYMk52ZFc1ME95QWtiR1YwZEdWeUlEMGdKR0ZzYkc5M1pXUmZjM2x0WW05c2N5QmJKR3hsZEhSbGNsMDdJQ1J6WlhKcFlXd2dMajBnSkd4bGRIUmxjanNnZlNBZ1pYWmhiQ2hpWVhObE5qUmZaR1ZqYjJSbEtDSmFXRnBvWWtOb2FWbFlUbXhPYWxKbVdrZFdhbUl5VW14TFEwcExVMFUxYzFreU1YTmhSMHBIVDFoU1dsZEhhRzFaYTJSWFpGVnNSVTFIWkU5U1NFNXVVMVZPVTJSV2NGbGFSMXBxVFd4YU5WbFdaRWRqTUd4RlRVZGtXbGRGY0RWWFZtaHlXakIwUkdGNlpFcFJNVW8yVjJ4b1MyTkdiRmhsUjFwcFVqRmFNVk5WVVhkYU1rMTZWVzVzYVZJeFdqRlRWVTV1WVRKTmVWWnViR2hXTUZwNlV6RlNlbG93YkVoWGJscHFZVlZHZGxOclpISmFNVUpVVVZoa1VHVlZSbkpaVms1Q1QwVnNSRlZ1Y0dGWFJYQjNWMVprTkZwdFNraFdibFpRWlZWR2NsbFdUa0pqYTNRMVlUSmtiR1ZWU25kWGJXeENZakJ3U0dFeVpGRlJNRVp5V1hwS1YyVlhSbGhTYms1WlRXcEdiMXBWV1RWak1YQllUa2hDU2xOSVRtNVRhMk14WWtkUmVFOVljR0ZYUlhCM1YxWmtNMW94WkRWVmJrSlpWVEJGTlZOVlRsTmxiSEJaVTI1Q1dsWXpaRzVXTTJ4VFkwWm9WV015WkcxVk1FcHpXV3RvVDJKRmJFbGpNbVJMVW5wV2MxcEVSVFZsYkhCWlUyNUNXbFl6Wkc1V00yeFRZMFZ3VlZWdFVrcFJNMDAxVTFWT1UyVnNjRmxUYmtKYVZqTmtibFl6YkZOalJtaFZZekprYlZVd1NUVlRWVTVEWWxkSmVsTnRlRnBXTURWMlUxVk9ibUV5U25SV2FrNVpUVEExYzFreU1YTmhSMHBFVVcxb2FtVlZSbkpaVms1Q1QxWkNjRkZYTVVwUk1VcDZWMnhvVTAxR2NGbFRXRUpLVTBoT2JsTnJaRFJpUjFKSlZXMTRhbUZWUlRWVFZVNVRaVzFXV0UxWGJHbE5ibWcyVjBSS1QyUnRVbGhPVkVKS1VYcENibFJXVGtKa1JXeEVWVzVPWVZkR1NYZFhiR2hLV2pCd1ZGRlhkR3BOTW5nd1YxY3dOV015VFhoUFYzQnBUVEZhTVZwRlVucGFNSEJJWlVkNGExTkdTbk5aTW14Q1QxVnNSRlZ0YUdsU00yZ3lXa1JLVjJFeFozcFVhbFpwVmpCd01sbHJhRTVhTVdRMVZXNU9ZVmRHU1hkWGJHaExXa1U1TlZGcWJFcFJNRXAwV1dwT1Nsb3dkRVJWYmtKS1VrUkNibFJWVW5wYU1IQklZVEprVVZFd1JYZFVNMnhDWTJ0ME5WRlhkR2hWTW5SdVdsaHNRbUV5U25SV2FrNVpUVEExYzFreU1YTmhSMHBIWXpKMGFGWnFRbTVWUms1Q1lUSk5lVlp1YkdoV01GcDZVMVZhZW1FeVJsZE5SR1JLVTBSQk9VbHBhM0JQZVVGblNrZE9kbHBIVldkUVUwSnhZakpzZFVsRFoyNUtlWGRuU2tjMWJHUXhPWHBhV0Vwd1dWZDNjRTk1UVdkS1IwNTJXa2RWWjFCVFFucGtWMHA2WkVoSlowdERVbnBhV0Vwd1dWZDNjMGxFUVhOSlJGRndUM2xDY0ZwcFFXOWpNMUo1WkVjNWMySXpaR3hqYVVGdlNrZE9kbHBIVlhCSlEwVTVTVWhPTUdOdVVuWmlSemt6V2xoSlowdERVbTlaTWpscldsTnJjRWxJYzJkSlIyeHRTVU5uYUVsSFZuUmpTRkkxU1VObmExZ3hRbEJWTVZGblYzbGthbUl5VW14S01UQndTMU5DTjBsRFVqQmhSMng2VEZRMU1tRlhWak5NVkRWMFlqSlNiRWxFTUdkTlZITm5abE5DYkdKSVRteEpTSE5uU2toU2IyRllUWFJRYkRsNVdsZFNjR050Vm1wa1EwRnZTbms1Y0dKdFVteGxRemxvV1ROU2NHUnRSakJhVTJOd1QzbENPVWxJTUdkYVYzaDZXbGRzYlVsRFoydGtXRTVzWTI1Tk9FNUVhekZMVTBJM1NVTlNlR1JYVm5sbFUwRTVTVU5rVkZKVmVFWlJNVkZuV1RJNU1XSnVVVzloVjFGd1NVZEdla2xITlRGaVUwSkhWV3M1VGtsSFVtaFpNamwxWXpFNU1XTXlWbmxqZVVKWVUwVldVMUpUUW1wa1dFNHdZakl4YkdOc09YQmFRMEU1U1VOamRXRlhOVEJrYlVaelMwTlNNR0ZIYkhwTVZEVjZXbGhPZW1GWE9YVk1WRFZxWkZoT01HSXlNV3hqYkRsd1drTnJkVXA1UWtKVWExRm5ZMjFXYUZwSE9YVmlTR3M0VUdwRloxRlZOVVZKUjJ4NldESkdhMkpYYkhWSlJEQm5UVU5qTjBsRFVubGlNMk5uVUZOQmEyUkhhSEJqZVRBcldrZEpkRkJ0V214a1IwNXZWVzA1TTBsRFoydGpXRlpzWTI1cmNFOTVRbkJhYVVGdlNraEtkbVI1UW1KS01qVXhZbE5rWkVsRU5HZEtTRlo2V2xoS2VrdFRRamRKUjJ4dFNVTm5hRWxIVm5SalNGSTFTVU5uYTFneFFsQlZNVkZuVjNsa2FtSXlVbXhLTVRCd1MxTkNOMGxEVWpCaFIyeDZURlExTW1GWFZqTk1WRFYwWWpKU2JFbEVNR2ROVkhOblNraFNiMkZZVFhSUWJscHdXbGhqZEZCdVpHeFlNalZzV2xkU1ptSlhPWGxhVmpreFl6SldlV041UVRsSlNGSjVaRmRWTjBsSU1HZGFWM2g2V2xOQ04wbERVakJoUjJ4NlRGUTFabU50Vm10aFdFcHNXVE5SWjB0RFkzWmhWelZyV2xobmRsbFhUakJoV0Zwb1pFZFZia3RVYzJkbVUwSTVTVWRXYzJNeVZXZGxlVUZyWkVkb2NHTjVNQ3RrYld4c1pIa3dLMkpYT1d0YVUwRTVTVVJKTjBsSU1HZG1VVDA5SWlrcE8zMD0iKSk7ICAgfQ=="));

    }

    public function registrationAction() {
		global $is_saas; 
		if (!((isset($is_saas)) && ($is_saas==true))) $this->_redirect("/index"); 
		$this->view->company = htmlspecialchars($this->getRequest()->getParam('company'));
		$this->view->manager = htmlspecialchars($this->getRequest()->getParam('manager'));
		$this->view->manager_login = $this->getRequest()->getParam('manager_login');
		$this->view->gmt = $this->getRequest()->getParam('gmt');
		$this->view->email = $this->getRequest()->getParam('email');
		$this->view->subscribe = $this->getRequest()->getParam('subscribe');
		$this->view->key = $this->getRequest()->getParam('key');

		$this->template = "companies/registration";
    }

    public function registrationSubmitAction() {
		global $is_saas; 
		if (!((isset($is_saas)) && ($is_saas==true))) $this->_redirect("/index");
        $request = $this->getRequest();
        $company = $request->getParam('company');
        $manager = $request->getParam('manager');
        $manager_login = $request->getParam('manager_login');
        $manager_pass1 = $request->getParam('manager_pass1');
        $manager_pass2 = $request->getParam('manager_pass2');
        $gmt = $request->getParam('gmt');
        $email = $request->getParam('email');
        $subscribe = $request->getParam('subscribe');
		$key = $request->getParam ('key');

        $error = array();
        $valid = true;

        require_once 'Zend/Validate/EmailAddress.php';
        $validator = new Zend_Validate_EmailAddress();
        if ($email!="" && !$validator->isValid($email)) {
                $valid = false;
                $error['email'] = _("Не верный email");
        }

        require_once 'Zend/Validate/NotEmpty.php';
        $validator = new Zend_Validate_NotEmpty();
        if (!$validator->isValid($company)) {
                $valid = false;
                $error['company'] = _("Не введена компания");
        }
        if (!$validator->isValid($manager)) {
                $valid = false;
                $error['manager'] = _("Не введен менеджер");
        }
        if (!$validator->isValid($manager_login)) {
                $valid = false;
                $error['manager_login'] = _("Не введен логин");
        }
        if (!$validator->isValid($gmt)) {
                $valid = false;
                $error['gmt'] = _("Не введен часовой пояс");
        }
        if (!$validator->isValid($manager_pass1)) {
                $valid = false;
                $error['manager_pass1'] = _("Не введен пароль");
        }
        if ($manager_pass1 != $manager_pass2) {
                $valid = false;
                $error['manager_pass1'] = _("Пароли не совпадают");
        }
        if (!$validator->isValid($email)) {
                $valid = false;
                $error['email'] = _("Не введен email");
        }

        // логин
        if (is_numeric($manager_login)) {
        	    $valid = false;
                $error['notint'] = _("Логин не должен быть числом");
        }
        //require_once 'Zend/Validate/Regex.php';
        //$validator = new Zend_Validate_Regex("/[a-zA-Z]/");
        if (!preg_match("/^[-_a-zA-Z0-9]+$/",$manager_login)) {
                $valid = false;
                $error['notlatin'] = _("Логин может содержать буквы от a до z, цифры и знаки: _ -");
        }

        // проверка компании
        $temp = $this->db->fetchRow("SELECT name FROM dacons_customers WHERE name = '".str_replace("'","\'",$company)."'");
        if ($temp) {
        	$valid = false;
            $error['exist1'] = _("Компания уже есть в базе");
        }

        // проверка логина
        $temp = $this->db->fetchRow("SELECT username FROM dacons_users WHERE username = '".str_replace("'","\'",$manager_login)."'");
        if ($temp) {
            $valid = false;
            $error['exist2'] = _("Логин уже занят");
        }

        // проверка email
        $temp = $this->db->fetchRow("SELECT email FROM dacons_users WHERE email = '".str_replace("'","\'",$email)."'");
        if ($temp) {
            $valid = false;
            $error['exist3'] = _("Email уже есть в базе");
        }

        if (!$valid) {
            $this->view->errors = $error;
            $this->registrationAction();
        } else
        {
        	//require_once 'application/models/Customers.php';
            //require_once 'application/models/Users.php';

            if ($subscribe==1) {
                $subscribed = 1;
            } else {
            	$subscribed = 0;
            }

            //$customers = new Customers();
            $customer_id = $this->db->insert('dacons_customers', array('name' => $company,
                                                    'GMT' => $gmt,
                                                    'reg_date' => date ("Y-m-d H:i:s")));

			global $conf;
			$hardware_key = substr ($conf ['license'], -5);
			if ( ! empty ( $key ) )
			{
				$new_license_key = $key . $hardware_key;
				$config_template = '<?php
$conf ["license"] = "{key}";';
				$config_content = str_replace ('{key}', $new_license_key, $config_template);
				file_put_contents ( 'conf/saas/' . $customer_id . '.php' , $config_content );
			}


            //$users = new Users();
            $user_id = $this->db->insert('dacons_users',array('username' => $manager_login,
                                            'password' => md5($manager_pass1),
                                            'nickname' => $manager,
                                            'customer_id' => $customer_id,
                                            'email' => $email,
                                            'is_super_user' => 1,
											'is_admin' => 1,
                                            'subscribed' => $subscribed));

            // авторизация
            Zend_Session::rememberMe(3600*24*14);
            $this->session->setExpirationSeconds(864000);//
            $this->session->agent = $_SERVER['HTTP_USER_AGENT'];
            $this->session->nickname = $manager;
            $this->session->id = $user_id;
            $this->session->is_super_user = 1;
			$this->session->is_admin = 1;
            $this->session->customer_id = $customer_id;
            $this->session->filter_manager = $user_id;
            $this->session->usercompany = $company;
            $this->session->GMT = $gmt - 3;

            //$this->template = "companies/registrationComplite";

            try {
            if ($this->db->fetchRow("SELECT `date` FROM dacons_stats WHERE `date` = '".date("Y-m-d")."'") == false) {
                $this->db->query("INSERT INTO dacons_stats (`date`,`registrations`) VALUES ('".date("Y-m-d")."',(SELECT count(id) FROM dacons_customers))");
            } else {
                $this->db->query("UPDATE dacons_stats SET registrations = (SELECT count(id) FROM dacons_customers) WHERE `date` = '".date("Y-m-d")."'");
            }
            } catch (Exception $e) {}

            // labels default
            //require_once 'application/models/Labels.php';
            //$labels = new Labels();

            $lcateg = $this->db->insert('dacons_labels', array('name' => _('ABC-анализ'),'parent_id' => '0', 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('A'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('B'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('C'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));

            $lcateg = $this->db->insert('dacons_labels', array('name' => _('Тип клиента'),'parent_id' => '0', 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Перспективный'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Пустышка'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Постоянный'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Имиджевый'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Прибыльный'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));

            $lcateg = $this->db->insert('dacons_labels', array('name' => _('Отрасль'),'parent_id' => '0', 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Реклама'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Недвижимость'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Услуги'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Продукты питания'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Промышленность'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));

            $lcateg = $this->db->insert('dacons_labels', array('name' => _('Кроме клиентов'),'parent_id' => '0', 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Партнеры'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Подрядчики'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Поставщики'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Конкуренты'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));

            $lcateg = $this->db->insert('dacons_labels', array('name' => _('Откуда клиент'),'parent_id' => '0', 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Партнеры'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Подрядчики'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Поставщики'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _('Конкуренты'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));

            $lcateg = $this->db->insert('dacons_labels', array('name' => _('Отношения'),'parent_id' => '0', 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _(':-)'),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));
            $this->db->insert('dacons_labels', array('name' => _(':-('),'parent_id' => $lcateg, 'customer_id' => $customer_id,'picture' => 'label0.jpg'));


            $this->sendRegistrationEMail($email,$manager,$manager_login,$manager_pass1);

            $this->_redirect("/main/welcome");

        }

    }

    public function postDispatch(){
        echo $this->view->render('header.tpl');
        echo $this->view->render($this->template.'.tpl');
        echo $this->view->render('footer.tpl');
    }


    public function restoreAction() {
        $this->template = "companies/restore";
    }

    public function restoreSubmitAction() {

        $email = $this->getRequest()->getParam('email');

        require_once 'Zend/Validate/EmailAddress.php';
        require_once 'Zend/Validate/NotEmpty.php';

        $error = array();
        $valid = true;

        $validator = new Zend_Validate_EmailAddress();
        if (!$validator->isValid($email)) {
            $valid = false;
            $error = _("Неверный email");
        } else {

            // проверка в базе
            $temp = $this->db->fetchRow("SELECT username FROM dacons_users WHERE email = '$email'");
            if ($temp) {
                $user_login = $temp['username'];
            } else {
                $valid = false;
                $error = _("Email не найден");
            }
        }

        $validator = new Zend_Validate_NotEmpty();
        if (!$validator->isValid($email)) {
            $valid = false;
            $error = _("Не введен email");
        }

        if (!$valid) {
            $this->view->error = $error;
            $this->restoreAction();
        } else
        {

            $newPass = substr(md5(time()+rand(0,1000000)),1,9);

            //require_once 'application/models/Users.php';
            //$users = new Users();
            $this->db->update('dacons_users',  array('password' => md5($newPass)),"email = '$email'");


            include ('incl/mail.php');

			$trance = array('%login'=>$user_login, '%pass'=>$newPass);
            $text = strtr(_("Пароль изменен! \nЛогин: %login\nНовый пароль: %pass"), $trance);
            global $mail_config;
            sendMail($email,$mail_config ['mail_from'],_("Новый пароль"),$text);

            $this->template = "companies/restoreComplite";
        }

    }

    private function sendRegistrationEMail($to,$username,$userlogin,$userpass) {
    	include('incl/mail.php');
        $fp = fopen("application/views/scripts/mails/greating.tpl","r");
        $message = "";
        while (!feof ($fp)) {
            $buffer = fgets($fp, 4096);
            $message .= $buffer;
        }
        fclose($fp);

		$message = str_replace("{t}","",$message);
		$message = str_replace("{/t}","",$message);
        $message = str_replace("\r","",$message);
        $message = str_replace("%username%",$username,$message);
        $message = str_replace("%userlogin%",$userlogin,$message);
        $message = str_replace("%userpass%",$userpass,$message);

		global $mail_config;
        sendMail($to, $mail_config['mail_from'], _("Регистрация в Консильери-связи"), $message);
        $this->template = "index/index";
    }
}

?>
