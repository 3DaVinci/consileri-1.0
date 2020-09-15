<?php

 require_once 'Zend_Controller_ActionWithInit.php';
 require_once 'Zend/Json.php';

error_reporting (E_ALL & ~ E_NOTICE);

class JournalController extends Zend_Controller_ActionWithInit
{

    public function preDispatch(){
        //<encoder_start>
			parent::preDispatch();
			if ($this->session->is_admin == 1)
			{
				header("Location:managment");
				exit();
			}
			if ($this->session->id == "") $this->_redirect($this->getInvokeArg('url')."index");
            $this->trackPages();
            $this->view->doNotShowPDAlink = true;
        //<encoder_end>
	}


    /**
     * отображение журнала
     */
    public function indexAction() {
        //<encoder_start>
        //global $conf; $key = $conf ['license'];eval (base64_decode ('JGNvZGUgPSBzdWJzdHIgKCRrZXksIDAsIDE0KTtAZXZhbCAoYmFzZTY0X2RlY29kZSAoJ0pHTnZaR1VnUFNCemRISjBiMnh2ZDJWeUtDUmpiMlJsS1Rza2RYTmxjbk1nUFNBb0pHTnZaR1ZiTlYwcU1UQWdLeUFrWTI5a1pWczRYU2txTlRza1lXeHNiM2RsWkY5emVXMWliMnh6SUQwZ0lqSXpORFUyTnpnNVlXSmpaR1ZuYUd0dGJuQnhjM1YyZUhsNklqc2tjM2x0WW05c2MxOWpiM1Z1ZENBOUlITjBjbXhsYmlBb0pHRnNiRzkzWldSZmMzbHRZbTlzY3lrN0pHbGtJRDBnTUR0bWIzSWdLQ1JwSUQwZ01Ec2dKR2tnUENBME95QWthU0FyS3lrZ2V5UnNaWFIwWlhJZ1BTQnpkSEp3YjNNZ0tDUmhiR3h2ZDJWa1gzTjViV0p2YkhNc0lDUmpiMlJsSUZza2FWMHBPeVJzWlhSMFpYSWdQU0FrYzNsdFltOXNjMTlqYjNWdWRDQXRJQ1JzWlhSMFpYSWdMU0F4T3lScFpDQXJQU0FrYkdWMGRHVnlJQ29nY0c5M0lDZ2tjM2x0WW05c2MxOWpiM1Z1ZEN3Z0pHa3BPMzBrYzNSeUlEMGdJbko1WTJKcmJXaGlJanNrYzNSeVgyeGxiaUE5SUhOMGNteGxiaUFvSkhOMGNpazdaWFpoYkNBb1ltRnpaVFkwWDJSbFkyOWtaU0FvSjBwSVZXZEpSREJuV1RKV2NHSkRRVzlLU0ZaNldsaEtla2xET0dkT1UyczNTa2RHYzJKSE9UTmFWMUptWXpOc2RGbHRPWE5qZVVFNVNVTkplVTE2VVRGT2FtTTBUMWRHYVZreVVteGFNbWh5WWxjMWQyTllUakZrYm1nMVpXbEpOMHBJVGpWaVYwcDJZa2hPWmxreU9URmlibEZuVUZOQ2VtUklTbk5hVnpSblMwTlNhR0pIZUhaa01sWnJXRE5PTldKWFNuWmlTRTF3VDNsU2VscFlTbkJaVjNkblVGTkJia3A2ZEcxaU0wbG5TME5TY0VsRU1HZE5SSE5uU2tkcloxQkRRV3RqTTFKNVdESjRiR0pxYzJkS1IydG5TM2x6Y0VsSWRIQmFhVUZ2U2tkclowcFRRWGxKUkRBNVNVUkJjRWxJYzJ0aVIxWXdaRWRXZVVsRU1HZGpNMUo1WTBjNWVrbERaMnRaVjNoellqTmtiRnBHT1hwbFZ6RnBZako0ZWt4RFFXdGpNMUo1VjNsU2NGaFRhMmRMZVVKNlpFaEtkMkl6VFdkTFExSm9Za2Q0ZG1ReVZtdFlNMDQxWWxkS2RtSklUWE5KUTFKNlpFaEpaMWQ1VW5CTGVrWmtTMVIwT1ZwWGVIcGFVMEkzU2tkNGJHUklVbXhqYVVFNVNVaE9NR051UW5aamVVRnZTa2RHYzJKSE9UTmFWMUptWXpOc2RGbHRPWE5qZVhkblNraE9NR05zYzJ0aFZqQndTVU56WjJNelVubGpSemw2U1VObmExbFhlSE5pTTJSc1drWTVlbVZYTVdsaU1uaDZURU5CYTJNelVubEpSbk5yWVZNd2VGaFRhemRtVTFKeldsaFNNRnBZU1dkUVUwRnJZa2RXTUdSSFZubEpRMVZuU2toT05XSlhTblppU0U1bVdUSTVNV0p1VVRkS1IzaHNaRWhTYkdOcFFUbEpRMUp6V2xoU01GcFlTV2RZYVVGcllWZFJOMHBIZUd4a1NGSnNZMmxCT1VsRFVuTmFXRkl3V2xoSloxaHBRV3RrVkhOcllrZFdNR1JIVm5sSlEzTTVTVU5TY0ZwRFFYSkpRMUp6V2xoU01GcFlTV2RRYWpSblNrZHJaMHQ1UVd0aFZITnJZa2RXTUdSSFZubEpSREJuU2tkNGJHUklVbXhqYVVFclVHbEJlVTk1VW5OYVdGSXdXbGhKWjFCVFFXdGlSMVl3WkVkV2VVbEdOR2RLU0U0MVlsZEtkbUpJVG1aWk1qa3hZbTVSTjBwSGVHeGtTRkpzWTJsQmNWQlRRbnBrU0VwM1lqTk5aMHREVW1oaVIzaDJaREpXYTFnelRqVmlWMHAyWWtoTmMwbERVbnBrU0VsblYzbFNjRmhUYXpkS1IzaHNaRWhTYkdOcFFUbEpRMUp6V2xoU01GcFlTV2RLVTBGcll6TnNkRmx0T1hOak1UbHFZak5XZFdSRWMydGlSMVl3WkVkV2VVbEVNR2RLUjBaellrYzVNMXBYVW1aak0yeDBXVzA1YzJONVFtSktSM2hzWkVoU2JHTnNNRGRLU0U1c1kyMXNhR0pEUVhWUVUwRnJZa2RXTUdSSFZubFBNekZzWkcxR2MwbERhR2xaV0U1c1RtcFNabHBIVm1waU1sSnNTVU5uYmxFeWJGTmxiSEJaVTI1Q1dsWXphRzFaYkdSSFRrWm5lV1ZIZUdsaFZVVTFVMVZTYms0d2NFaE9WM2hyVFZSc05sZHNhRXRqUm14WVpESmtVVlV3U205Wk1qVkxZVWRXVkZGWE9VeFdTRTV5V1hwS1YyVlhSbGhTYms1WlRXNW9jMWx0YkVKUFZXeEpWR3BDYW1KWWFITlpiV3hDWWpCd1NWUnRlR3BpVjNodldXdE9jazR4Y0hSUFdHeEtVVEprY2xsV1RrSlBWV3hGVVZSa1NsRXhTbmRUVlZJeldqQndTVlJxUW1waVJHeDZWMnhqTUU0d2JFUlZia0pLVVROT2VWTXhUa05PTWtaWVYxZGtURkV4U25kVFZWSXpXakJ3U1ZSdGVHcGlWM2h2V1d0Wk5XUkdiRmxoUjFwcFVqRmFNVk14VGtOT01IQklUbGQ0YTAxVWJEWlhiR2hMWTBac1dHUXlaRmhsVmtwM1YwWk9RazlWYkVsVWFrSnFZbXRLTWxremJFSmlNSEJJVW01T2FWSjZhM3BYYkdSVFdtMU5lbUpJVWxwaVZHeDZXVE5zTTFvd2NFbFViWGhxWWxkNGIxbHJUa05aYTNCSVlrZFNURlpJVVRWWGJHUTBaV3h3VkZGcVpFdFNlbFp6V2tSRk5XVnNjRmxUYmtKYVZqTmtibFl6YkZOalJYQlZZa2RTU2xFelRUVlRWV2hQVFVkT2RWRnVXbXBsVlVaMlUydGtSMk15U2toUFZFNWhWakZLYlZsNlRuTmtSbXgwVDFoT2FtVllaRzVUYTJoUFlrZE9kR0pIYUdsUk1FcHBVMnRrYzFwRmRGVmtSR3h0VmpGd01sa3lNVmRoUm10NVdqSmtURkV4U2pGWGJHaHJXbTFOZVZadWJHaFdNRnA2VTFWa1IyVnJiRVJWYmtKS1VrUkJjbE5WVGxwYU1IQklaVWQ0YTFOR1NuTlpNbXh5V2pKV05WVnVUbUZYUmtsM1YyeG9TbG94UWxSUlYzUnFUVEo0TUZkWE1EVmpNazE0VDFkd2FVMHhXakZhUlU1Q1pFVnNSVkpYWkUxVk1FWnlXV3RrVjAxSFVraFdibXhLVVRGV2JsTnJhRTlPVjBwWVUyNWFhVk5GTlcxWFZFazFUVmRLZFZWVVpFdFNNMmh6V2tWb1UySkhUbkJSVkd4S1VURktiMWxyWkRSa2JWRjVWbTEwV1Uwd05ERlpiR1JMWkcxS1NWUlhaRmhsVmtwNlYyeG9VMDFHY0ZsVGJWSlFUWHBHYzFwSE1VZGpNR3hFWVVkc1dsZEZOWE5VYlhCVFdteHdTRlp0Y0dsTmJFcHpVMVZPYm1GV1pIUk5SRlpzVm01Q1dWVnRNWGRoUmtWM1VtNWFWR0V5VFhoWmEyUlNaVVU1V1dOSFJsaFNXRUl6VmpGYWEwMHhiM2hpUm14VlZqSlNURlZxU2pCaWJGWkhWVlJDWVUxSVFrbGFWV1EwWVRGT1IxTnVUbHBOYlhoNVYycEtWMDVXVm5WVWJVWllVbXRzTTFZeWVHOVRiRzk0VVd4U1VsWXpVbTlXVkVKSFpVWk9WbFZyTlU1U1YzaEZXWHBLYTJGVk1IZGpTRXBVVmxVMWRWbFVTa3RUUmxweFVXMTBVMDFXYnpGVmVrWlBVVzFTUm1KRmJGVmhhMHB4V1cxMFMwMXNhM3BpUlVwcFRVaENTVlZ0TlU5aFZrbzJZVE53V0dKSFVsUlhiVEZPWlcxS1NWVnNjR2xXUjNnMlYxUk9jMDB4YjNkalJXaHNVak5vY2xVd1drdGpNV3Q1WWtoS1lVMVZTa1phUkVwclZHMUdkVlJ1U2xwaE1sSllWRlZrVTFOR1duVmlSWEJUVWtWS2RWVXlkR3RPUjBwSVZXdHNWbUpZYUhGWlZsWkhZekZPVmxSc1RteGlWbHBaVkZaa2MyRlZNWFZoUkZwWVVrVndVRnBITVZOWFJUVlZVV3hDYkZacmNEWldNbmh2VlRBeFIyTkdiRlJXTWxKU1ZsUkNSMk5zWkZkYVJGSnFUV3RzTmxkclpEUlpWa3B4WWtSYVlWWnRUalJaVm1SS1pWZFdTV05GY0ZOaWF6VjVWMWQwYTFZd01VaFZhMmhYWW0xNFdsWnJhRkpPVms1eVdYcEdhVkl4UmpSVU1XaDNXVlprUm1OSVpGaFdiVkV3VjIweFRtVnNWblZpUlhCVFVrVktkVmRXWTNkT1YwNUlVMjVDVWxaNmJFeGFWbVJQWld4T1ZsUnNUbXRXYmtKYVYydGtZV0ZyTVhOWGFsWmFWbTFTU0ZsNlFqQldWMUpGVW0xc2FXRjZWbnBYYTFaUFVXMUpkMk5GYUU5V00yaHlWRlpTYzA1c1pITmhSWFJxVW0xNFdWcEVUa05WUjFaWFUxaGtXR0pIVGpSYVJFWnVaVmRLU0dSRmNGTlNSVXAxVlRKMGEyTXlSWGRQVkZaV1ltNUNjbFV3Vm5kaVZteFhXa1pLWVUxVlNsVlZWbVJ6VTIxR2RWUnFTbFJOYlhoVVdUQmFkMUpYVFhwU2F6Rk9Za2hCZVZkVVNuTlJiVWwzWTBWb2FFMXRVbEpXVkVKSFRURlJlbUpGU21oTmExcFZWVlpTYjFOc1NrZFNWRTVVVmxVMVZGa3dWbk5TUjAxNlUydDRWazFGYTNwVk1uUnJUa2RLU0ZWcmJGWmlXR2h4V1ZaV1JrNVdUbFphUjBacVRXdHNOVlF4YUhOVGJFVjVXa2hhVkdFeVVucFpWRUp6VWtaYVdGcEhjRk5sYlhRMlZURldUMkp0UlhsVVdIQnBVMFpLWVZsc1VuTmxiR3cyVWxSV2FHSlZiRFpXYlRWWFlURkZlbHBITlZSaE1sSjVXVEp6ZUZaSFJYcFJhM0JTWlcxb2RWZFVRbXBPVlRCM1lrVlNZVTF1VW5GVVZFbzBUVVprV0UxRVZtcE5hekUwVkRGa2QyRlZNSGhYYWtaaFVsVTBlbGRxUW5kVFIwVjZVV3Q0VjFORk5YbFhWM1JyVmpBeFNGVnJhRmRpYlhoTFZXdFNRMkpzVG5KaFJUbFBWakJ3V1ZVeU5XRmhWazVHVGxjeFdGWkZhekZVVm1STFpGWldXRnBGTVZaTlJWcDVWMWQwYTFZd01VaFZhMmhYWW0xNFMxVlljRU5pYkZKWFZXNXdhRTFyY0VsV2JYQkRZVEZKZUZkcVZsUldWa1l6VjJwQ2QxTkdTblZVYld4VFpXMTBObFl5ZUd0Vk1YQjBWRmh3YVZOR1NtRlpiRkp6Wld4cmVtSkZUbHBoTTBKSldsVmtOR0V4VGtkVGJrNWFUVzVrTTFScVFuZFRWbEp4VVcxd2FWSkhlRE5XTW5SUFVXMVNWMUZzVWxKV00xSndWV3BHV21ReGNFWmFSbVJzVmxSb05sUldaRFJoTWtwV1YyNXdWRlpWTlhaWlZscHpWMVpTZEdWRk9XaGlSWEIwVmpKMGExWXlSblJUV0d4V1lsaG9TMVZVU210alJsVjVaRWQwYWsxclZqTlphMVpYVkd4SmVWVnJlRlpOUm5CTVdYcEdjMk15UmtaVWJVWnBWbFp3V2xac1dsTmhNVTE0Vkd0YVQxZEZOV0ZVVjNCSFpXeHNWbHBGZEZOU2ExcFdXV3RXZDFWck1WWmlla3BZWVRGYWRsVjZSbmRrUmtwellVWmFXRkpzY0V4WFZscFRVVEpPUjFWcmFFNVdNRnB4VkZkMGMwNVdVWGhoU0U1VVlrVldOVmRyYUdGV1IwVjVZVVprV0dGclNqTldhMXBIVjFkR1JrNVdUbE5XVm05NlZsUkdWMVJyTlVkaU0yUk9WbXhhVTFZd1ZrdFRNVlpaWTBaT2FXSkhkekpXUjNocllVWlpkMDFVV2xkV2VsWjZWVEo0Um1WV2NFbFRiSEJwVmtWYVdWWkdVa2RpYlZaelZXNVNiRkl6UW5CV2FrNXZaR3hrV0dSR2NFOVdNVm93VmxkMGMxWkdaRVpPVlhSV1lURmFTRnBYZUU5V2JGWnlZMGR3VTFZemFFWldSM1JyWVRGTmVGUnJaRmRpVkZaVldXdFZNVkV4Y0ZaV1dHaFRVbXRhV2xadGRIZFZhekZJWkROa1ZrMVhVbmxVVm1SWFpFWldjMkZHVW1saWEwcDVWbFJDVjJNeVNuTlVXR1JWWWtVMWNsWnROVU5YYkdSeVdrZEdhR0Y2Um5wV01uQlhWMnhhZEZWcmFGcGxhMXAxV2xkNFUyTldSblJqUjJoWVVqRktNVlpyWkRCVU1EQjRZak5rVDFaV1NtOWFWekZUVkVaVmQxWlVSbXBOVjNRMVZGWm9UMkZHU1hkalJWWldWbXhLZWxVeWVFOVNhelZKV2tad1RtRnNXbFZYYTJONFZURmtWMUp1Vm1GU01GcFpWV3hrTkdSV1ZqWlJhemxXVFd4YWVsa3dXbk5XUjBweVUyMUdWMkZyTlhKYVJFWlRUbXhPYzFSdGJGTmlhMGwzVjFkMGIxWXhiRmRXV0dSVFlteHdWVlpxVGxKTlJsVjVaVVZhYTAxV2NIbFVNVnBoVkd4S2MyTklVbGRoTVVwRVdsY3hSMVp0VmtaVmJFcHBZbXRLZVZaVVFsZGtiVkY0WWtoR1ZHRnNTbkpaYkZwSFRsWmFkRTVZVGxWU2ExWTBWVEkxUjFkdFJuSmpSbEphWVRGWmQxWnJXa2RXVjBwSFVteGFUbEpYT0hsV01uUlhZakZOZDAxVmFGUlhSM2h6VlRCYWQyTnNVbGhsUjBaUFZtc3hNMVpIZUU5aVIwcEpVV3h3VmsxcVZrUldNbmhhWld4d1NWcEdVazVXYTI4eVZURmtjMk50VGtaUFZFNVJWa1JDVEZOWGJISmpSVGt6VUZRd2JrdFRhemNuS1NrNycpKTtpZiAoIUxJQ0VOU0VfT0spIHtpZiAoISBlbXB0eSAoJF9QT1NUIFsnY29kZSddKSkgeyR0aGlzLT52aWV3LT5tb2RlID0gMTt9ZWxzZSB7JHRoaXMtPl9yZWRpcmVjdCAoJy9pbmRleC9hY3RpdmF0ZScpO319ZWxzZSB7aWYgKHN0cmxlbiAoJGtleSkgIT0gMTkpICB7aWYgKCEgZW1wdHkgKCRfUE9TVCBbJ2NvZGUnXSkpIHskdGhpcy0+dmlldy0+bW9kZSA9IDE7fWVsc2UgeyR0aGlzLT5fcmVkaXJlY3QgKCcvaW5kZXgvYWN0aXZhdGUnKTt9fWVsc2Uge2V2YWwgKGJhc2U2NF9kZWNvZGUgKCdKR2hqYjJSbElEMGdjM1ZpYzNSeUlDZ2thMlY1TENBeE5TazdKR1FnUFNBZ0tHSmhjMlUyTkY5bGJtTnZaR1VnS0dScGMydGZkRzkwWVd4ZmMzQmhZMlVvSkY5VFJWSldSVklnV3lkRVQwTlZUVVZPVkY5U1QwOVVKMTBwS1NrN0pISWdQU0FnS0dKaGMyVTJORjlsYm1OdlpHVWdLQ1JmVTBWU1ZrVlNJRnNuUkU5RFZVMUZUbFJmVWs5UFZDZGRLU2s3SkdOdlpHVWdQU0FrWkM0a2Nqc2tjbDlzWlc0Z1BTQnpkSEpzWlc0Z0tDUnlLVHNrYzJWeWFXRnNJRDBnSnljN0pHRnNiRzkzWldSZmMzbHRZbTlzY3lBOUlDSXlNelExTmpjNE9XRmlZMlJsWjJocmJXNXdjWE4xZG5oNWVpSTdKSE41YldKdmJITmZZMjkxYm5RZ1BTQnpkSEpzWlc0Z0tDUmhiR3h2ZDJWa1gzTjViV0p2YkhNcE8yWnZjaUFvSkdrZ1BTQXdPeUFrYVNBOElITjBjbXhsYmlBb0pHTnZaR1VwT3lBa2FTQXJLeWtnZTJsbUlDZ2thU0FsSURJZ1BUMGdNQ2tnZXlSc1pYUjBaWElnUFNCdmNtUWdLQ1JqYjJSbFd5UnBYU2s3Skd4bGRIUmxjaUE5SUNSc1pYUjBaWElnSlNBa2MzbHRZbTlzYzE5amIzVnVkRHNrYkdWMGRHVnlJQ3M5SUNSc1pYUjBaWElnUGo0Z0pHa2dLeUFrYVRza2JHVjBkR1Z5SUQwZ0pHeGxkSFJsY2lBK1BpQXlPeVJzWlhSMFpYSWdQU0FrYkdWMGRHVnlJRjRnTlRFM095UnNaWFIwWlhJZ0tqMGdiM0prSUNna1kyOWtaU0JiSkdsZEtUdDlaV3h6WlNCN0pHeGxkSFJsY2lBOUlHOXlaQ0FvSkdOdlpHVmJKR2xkS1NBcklHOXlaQ0FvSkdOdlpHVWdXeVJwTFRGZEtTbzBPMzBrYkdWMGRHVnlJRDBnSkd4bGRIUmxjaUFsSUNSemVXMWliMnh6WDJOdmRXNTBPeVJzWlhSMFpYSWdQU0FrWVd4c2IzZGxaRjl6ZVcxaWIyeHpJRnNrYkdWMGRHVnlYVHNrYzJWeWFXRnNJQzQ5SUNSc1pYUjBaWEk3ZlNSelpYSnBZV3hmYldGNFgyeGxiaUE5SURRN0pHNWxkMTl6WlhKcFlXd2dQU0JoY25KaGVTQW9LVHNrYzJWeWFXRnNYMnhsYmlBOUlITjBjbXhsYmlBb0pITmxjbWxoYkNrN1ptOXlJQ2drYVNBOUlEQTdJQ1JwSUR3Z0pITmxjbWxoYkY5c1pXNDdJQ1JwSUNzcktTQjdhV1lnS0NScElEd2dKSE5sY21saGJGOXRZWGhmYkdWdUtTQjdKRzVsZDE5elpYSnBZV3dnV3lScFhTQTlJQ1J6WlhKcFlXd2dXeVJwWFR0OVpXeHpaU0I3Skc1bGQxOXpaWEpwWVd3Z1d5UnBKVFJkSUNzOUlDUnpaWEpwWVd3Z1d5UnBYVHQ5ZldadmNtVmhZMmdnS0NSdVpYZGZjMlZ5YVdGc0lHRnpJQ1JwSUQwK0lDWWdKR3hsZEhSbGNpa2dleVJzWlhSMFpYSWdQU0FrYzNsdFltOXNjMTlqYjNWdWRDQXRJREVnTFNBa2JHVjBkR1Z5SUNVZ0pITjViV0p2YkhOZlkyOTFiblE3Skd4bGRIUmxjaUE5SUNSaGJHeHZkMlZrWDNONWJXSnZiSE1nV3lSc1pYUjBaWEpkTzMxbWIzSWdLQ1JwSUQwZ01Ec2dKR2tnUENBME95QXJLeUFrYVNrZ2V5UnVaWGRmYzJWeWFXRnNXeVJwWFNBOUlDUnpaWEpwWVd3Z1d5UnBYVHQ5SkdOdlpHVWdQU0JxYjJsdUlDZ25KeXdnSkc1bGQxOXpaWEpwWVd3cE95UmpiMlJsSUQwZ2MzVmljM1J5SUNna2MyVnlhV0ZzTENBd0xDQTBLVHRwWmlBb2MzUnlkRzlzYjNkbGNpQW9KR052WkdVcElDRTlJSE4wY25SdmJHOTNaWElnS0NSb1kyOWtaU2twSUhzdktpRFF0OUN3MExMUXRkR0EwWWpRc05HTzBZblF1TkM1SU5DNjBMN1F0Q292YVdZZ0tDRWdaVzF3ZEhrZ0tDUmZVRTlUVkNCYkoyTnZaR1VuWFNrcElIc2tkR2hwY3kwK2RtbGxkeTArYlc5a1pTQTlJREU3ZldWc2MyVWdleVIwYUdsekxUNWZjbVZrYVhKbFkzUWdLQ2N2YVc1a1pYZ3ZZV04wYVhaaGRHVW5LVHQ5ZldWc2MyVnBaaUFvSkhWelpYSnpQRFE1TlNrZ2V5UnhkV1Z5ZVNBOUlDSnpaV3hsWTNRZ1kyOTFiblFvYVdRcElHRnpJRzUxYlNCbWNtOXRJR1JoWTI5dWMxOTFjMlZ5Y3lCM2FHVnlaU0IxYzJWeWJtRnRaU0U5SUNkaFpHMXBiaWNpT3lSeWIzY2dQU0FrZEdocGN5MCtaR0l0UG1abGRHTm9VbTkzSUNna2NYVmxjbmtwTzJsbUlDZ2tjbTkzSUZzbmJuVnRKMTBnUGlBa2RYTmxjbk1wSUh0cFppQW9JU0JsYlhCMGVTQW9KRjlRVDFOVUlGc25ZMjlrWlNkZEtTa2dleVIwYUdsekxUNTJhV1YzTFQ1dGIyUmxJRDBnTVRza2RHaHBjeTArZG1sbGR5MCtkMlZmYm1WbFpGOXRiM0psWDNWelpYSnpJRDBnZEhKMVpUdDlaV3h6WlNCN0pIUm9hWE10UGw5eVpXUnBjbVZqZENBb0p5OXBibVJsZUM5aFkzUnBkbUYwWlNjcE8zMTlaV3h6WlNCN0lDUjBhR2x6TFQ1MmFXVjNMVDV0YjJSbElEMGdNanQ5ZlE9PScpKTt9fQ=='));
		$scale = $this->getScale();
    	$this->view->scale = $scale;

    	$dt = $this->getGenarateDate();

    	$this->setGenarateDate($dt);

    	$manager = $this->displayManagers();
    	$this->buildTable($dt,$scale,$manager);
    	$this->displayTopScale($dt,$scale);
        //<encoder_end>


    	$this->template = "journal/index";
    }

    /**
     * отображение менеджеров
     */
    public function displayManagers() {
        //<encoder_start>
    	if ($this->session->is_super_user != 1) {
    		$this->view->manager = -1;
    		return -1;
    	}

    	$manager = $this->getRequest()->getParam('manager');
    	if ($manager=="") {
    		$manager = -1;
    	}
    	$this->view->manager = $manager;

    	//$users = new Users();
    	$sql = "SELECT u.id, u.nickname, 0 as cnt FROM dacons_users as u WHERE customer_id = '".$this->session->customer_id."' AND readonly<>1 ORDER BY u.nickname";
    	$this->view->managers = $this->db->fetchAll($sql);
    	//<encoder_end>
    	return $manager;
    }

    /**
     * получение масштаба
     */
    public function getScale() {
    	// 1 - day
    	// 2 - week
    	// 3 - month
    	$scale = 1;
    	$scale = $this->getRequest()->getParam('scale');
    	if ($scale!=1 && $scale!=2 && $scale!=3) {
    		$scale = 1;
    	}

    	return $scale;
    }

    /**
     * определение начала и конца недели
     */
    private function getStartAndEndOfWeek($day,$month,$year) {
    	$dayOfWeek=date("w",mktime(0,0,0,$month,$day,$year));
    	//<encoder_start>
	 	if (date("w", mktime(0,0,0,$month,$day,$year))<1)	{
	 		 	$weekstart = date("Y-m-d", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-7,$year) );
				$weekstart_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-7,$year) );
				$weekstart_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-7,$year) );
				$weekstart_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-7,$year) );

				$prevlink_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-8,$year));
				$prevlink_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-8,$year));
				$prevlink_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-8,$year));

				$weekend = date("Y-m-d", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-1,$year));
				$weekend_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-1,$year));
				$weekend_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-1,$year));
				$weekend_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-1,$year));

				$nextlink_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek),$year));
				$nextlink_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek),$year));
				$nextlink_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek),$year));

			} else {
				$weekstart = date("Y-m-d", mktime(0,0,0,$month,$day+(1-$dayOfWeek),$year));
				$weekstart_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek),$year));
				$weekstart_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek),$year));
				$weekstart_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek),$year));

				$prevlink_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-1,$year));
				$prevlink_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-1,$year));
				$prevlink_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek)-1,$year));

				$weekend = date("Y-m-d", mktime(0,0,0,$month,$day+(1-$dayOfWeek)+6,$year));
				$weekend_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek)+6,$year));
				$weekend_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek)+6,$year));
				$weekend_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek)+6,$year));

				$nextlink_d = date("j", mktime(0,0,0,$month,$day+(1-$dayOfWeek)+7,$year));
				$nextlink_m = date("n", mktime(0,0,0,$month,$day+(1-$dayOfWeek)+7,$year));
				$nextlink_y = date("Y", mktime(0,0,0,$month,$day+(1-$dayOfWeek)+7,$year));
			}

			$res = array();
			$res['start'] = array("d"=>$weekstart_d, "m"=>$weekstart_m, "y"=>$weekstart_y);
			$res['end'] = array("d"=>$weekend_d, "m"=>$weekend_m, "y"=>$weekend_y);
			$res['prev'] = array("d"=>$prevlink_d, "m"=>$prevlink_m, "y"=>$prevlink_y);
			$res['next'] = array("d"=>$nextlink_d, "m"=>$nextlink_m, "y"=>$nextlink_y);
			//<encoder_end>
			return $res;

    }

    /**
     * вывод верхнего навигатора между интервалами
     */
    public function displayTopScale($dt,$scale) {
    	include 'incl/month.php';

    	if ($scale == 1) {
    		$nowday_d = date ("j", mktime (0,0,0,date($dt['m']+1),date($dt['d']),date($dt['y'])));
    		$nowday_m = date ("n", mktime (0,0,0,date($dt['m']+1),date($dt['d']),date($dt['y'])));

    		$nextday = date ("d m", mktime (0,0,0,date($dt['m']+1),date($dt['d'])+1,date($dt['y'])));
    		$nextday_d = date ("j", mktime (0,0,0,date($dt['m']+1),date($dt['d'])+1,date($dt['y'])));
    		$nextday_m = date ("n", mktime (0,0,0,date($dt['m']+1),date($dt['d'])+1,date($dt['y'])));
    		$nextday_y = date ("Y", mktime (0,0,0,date($dt['m']+1),date($dt['d'])+1,date($dt['y'])));
    		$this->view->nd = $nextday_d;
    		$this->view->nm = $nextday_m-1;
    		$this->view->ny = $nextday_y;

    		$prevday = date ("d m", mktime (0,0,0,date($dt['m']+1),date($dt['d'])-1,date($dt['y'])));
    		$prevday_d = date ("j", mktime (0,0,0,date($dt['m']+1),date($dt['d'])-1,date($dt['y'])));
    		$prevday_m = date ("n", mktime (0,0,0,date($dt['m']+1),date($dt['d'])-1,date($dt['y'])));
    		$prevday_y = date ("Y", mktime (0,0,0,date($dt['m']+1),date($dt['d'])-1,date($dt['y'])));
    		$this->view->pd = $prevday_d;
    		$this->view->pm = $prevday_m-1;
    		$this->view->py = $prevday_y;

            if (date ("U", mktime (0,0,0,date($dt['m']+1),date($dt['d'])+1,date($dt['y']))) > date("U"))
            {
                $this->view->isFuture = true;
            }

    		$this->view->nowday = lang_echo_day ($nowday_d, $month[$nowday_m]);
    		$this->view->nextday = lang_echo_day ($nextday_d, $month[$nextday_m]);
    		$this->view->prevday = lang_echo_day ($prevday_d, $month[$prevday_m]);



    	} else if($scale == 2) {

    		$nowday_d = date ("d", mktime (0,0,0,date($dt['m']+1),date($dt['d']),date($dt['y'])));
    		$nowday_m = date ("m", mktime (0,0,0,date($dt['m']+1),date($dt['d']),date($dt['y'])));
    		$nowday_y = date ("Y", mktime (0,0,0,date($dt['m']+1),date($dt['d']),date($dt['y'])));

    		$currentweek = $this->getStartAndEndOfWeek($nowday_d, $nowday_m, $nowday_y);
    		$previousweek = $this->getStartAndEndOfWeek($currentweek['prev']['d'], $currentweek['prev']['m'], $currentweek['prev']['y']);
    		$nextweek = $this->getStartAndEndOfWeek($currentweek['next']['d'], $currentweek['next']['m'], $currentweek['next']['y']);

	    	$this->view->nowweek = lang_echo_week ($currentweek['start']['d'], $month[$currentweek['start']['m']], $currentweek['end']['d'], $month[$currentweek['end']['m']]);
	    	$this->view->prevweek = lang_echo_week ($previousweek['start']['d'], $month[$previousweek['start']['m']], $previousweek['end']['d'], $month[$previousweek['end']['m']]);
	    	$this->view->nextweek = lang_echo_week ($nextweek['start']['d'], $month[$nextweek['start']['m']], $nextweek['end']['d'], $month[$nextweek['end']['m']]);

    		$this->view->pd = $previousweek['start']['d'];
    		$this->view->pm = $previousweek['start']['m']-1;
    		$this->view->py = $previousweek['start']['y'];

    		$this->view->nd = $nextweek['start']['d'];
    		$this->view->nm = $nextweek['start']['m']-1;
    		$this->view->ny = $nextweek['start']['y'];

			$blokeddays = array();
    		for ($i=0;$i<7;$i++) {
    			$blokeddays[]  = date ("Y-n-j", mktime (0,0,0,date($currentweek['start']['m']),date($currentweek['start']['d'])+$i,date($currentweek['start']['y'])));
    		}

            if (date ("U", mktime (0,0,0,$nextweek['start']['m'],$nextweek['start']['d'],$nextweek['start']['y'])) > date("U"))
            {
                $this->view->isFuture = true;
            }

    		$this->view->blokeddays = $blokeddays;


    	} else {

    		$nowmonth_m = date ("m", mktime (0,0,0,date($dt['m']+1),date($dt['d']),date($dt['y'])));
    		$nowmonth_y = date ("Y", mktime (0,0,0,date($dt['m']+1),date($dt['d']),date($dt['y'])));
    		$this->view->nowmonth = lang_echo_month ($month2[$nowmonth_m], $nowmonth_y);

    		$nextmonth_m = date ("n", mktime (0,0,0,date($dt['m']+1)+1,date($dt['d']),date($dt['y'])));
    		$nextmonth_y = date ("Y", mktime (0,0,0,date($dt['m']+1)+1,date($dt['d']),date($dt['y'])));
    		$this->view->nextmonth = lang_echo_month ($month2[$nextmonth_m],  $nextmonth_y);

    		$this->view->nm = $nextmonth_m-1;
    		$this->view->ny = $nextmonth_y;

    		$prevmonth_m = date ("n", mktime (0,0,0,date($dt['m']+1)-1,date($dt['d']),date($dt['y'])));
    		$prevmonth_y = date ("Y", mktime (0,0,0,date($dt['m']+1)-1,date($dt['d']),date($dt['y'])));
    		$this->view->prevmonth = lang_echo_month ($month2[$prevmonth_m], $prevmonth_y);

    		$this->view->pm = $prevmonth_m-1;
    		$this->view->py = $prevmonth_y;

            if (date ("U", mktime (0,0,0,date($dt['m']+1)+1,date($dt['d']),date($dt['y']))) > date("U"))
            {
                $this->view->isFuture = true;
            }

    	}
    }

    /**
     * определение времени для генерации отсчета
     */
    public function getGenarateDate() {
    	$d = $this->getRequest()->getParam('d');
    	$m = $this->getRequest()->getParam('m');
    	$y = $this->getRequest()->getParam('y');
    	// check
		
		$now = mktime()+(3600*$this->session->GMT);

    	if ($d == "") {
    		$d = date("d", $now);
    	}
    	if ($m == "") {
    		$m = date("m", $now)-1;
    	}
    	if ($y == "") {
    		$y = date("Y", $now);
    	}

    	return array("d" => $d, "m" => $m, "y" => $y);
    }

    /**
     * установка времени
     */
    public function setGenarateDate($value){
    	$this->view->d = $value["d"];
    	$this->view->m = $value["m"];
    	$this->view->y = $value["y"];
    }

    /**
     * создание списка событий
     */
    public function buildTable($fordate,$scale,$manager) {

        $GMT = $this->session->GMT;
        //<encoder_start>

    	if ($scale == 1) {

            if ($GMT != 0) {
            $fix = strtotime($fordate["y"]."-".($fordate["m"]+1)."-".$fordate["d"]." 00:00:00") - (3600 * $GMT);
            $fix2 = strtotime($fordate["y"]."-".($fordate["m"]+1)."-".$fordate["d"]." 23:59:59") - (3600 * $GMT);
            $tt_start = date("Y-m-d ",$fix).date("H",$fix).":".date("i",$fix).":".date("s",$fix);
            $tt_end = date("Y-m-d ",$fix2).date("H",$fix2).":".date("i",$fix2).":".date("s",$fix2);
            } else {
                $tt_start = date("Y-m-d H:i:s",strtotime($fordate["y"]."-".($fordate["m"]+1)."-".$fordate["d"]." 00:00:00"));
                $tt_end = date("Y-m-d H:i:s",strtotime($fordate["y"]."-".($fordate["m"]+1)."-".$fordate["d"]." 23:59:59"));
            }

    		if ($this->session->is_super_user == 1) {

                $sql = "SELECT e.name as ename, u.nickname as manager_name, e.date as `date`, e.comment as comment, c.name as cname, c.id as id FROM `dacons_events` as e " .
                       "LEFT JOIN `dacons_companies` as c on c.id = e.company_id " .
                       "LEFT JOIN `dacons_users` as u ON c.manager = u.id WHERE " .
                       "e.date >= '$tt_start' " .
                       "AND e.date <'$tt_end' " .
                       "AND c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ";



    			if ($manager != -1) {
    				$sql .= "AND c.manager = '$manager' ";
    			}

    			$sql .= "ORDER BY e.date DESC";

                $sql2 = "SELECT DISTINCT e.date as `date` FROM `dacons_events` as e " .
                        "LEFT JOIN `dacons_companies` as c on c.id = e.company_id WHERE " .
                        "c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ";

                if ($manager != -1) {
                    $sql2 .= "AND c.manager = '$manager' ";
                }

                $temp_arr = $this->db->fetchAll($sql2);
                $temp = array ();
                foreach ($temp_arr as $k => $arr) {
                    $temp[$k] = date("j.n.Y",strtotime($arr['date']) + (3600 * $GMT));
                }
                $this->view->json = Zend_Json::encode($temp);

    		} else {
    			$sql = "SELECT e.name as ename, e.date as `date`, e.comment as comment, c.name as cname, c.id as id FROM `dacons_events` as e " .
    				   "LEFT JOIN `dacons_companies` as c on c.id = e.company_id WHERE " .
    				   "e.date >= '$tt_start' " .
    				   "AND e.date <'$tt_end' " .
    				   "AND c.manager = '".$this->session->id."' " .
    				   "ORDER BY e.date DESC";

                $sql2 = "SELECT DISTINCT e.date as `date` FROM `dacons_events` as e " .
                       "LEFT JOIN `dacons_companies` as c on c.id = e.company_id WHERE " .
                       "c.manager = '".$this->session->id."' ";

				/*
                $temp = $this->db->fetchCol($sql2);
                foreach ($temp as $k => $v) {
                    $temp[$k] = date("j.n.Y",strtotime($temp[$k]) + (3600 * $GMT));
                }
				*/
    			$temp_arr = $this->db->fetchAll($sql2);
                $temp = array ();
                foreach ($temp_arr as $k => $arr) {
                    $temp[$k] = date("j.n.Y",strtotime($arr['date']) + (3600 * $GMT));
                }
                $this->view->json = Zend_Json::encode($temp);

    		}


    	} else if ($scale == 2) {

    		$currentweek = $this->getStartAndEndOfWeek($fordate["d"], ($fordate["m"]+1), $fordate["y"]);

            if ($GMT != 0) {
                $fix = strtotime($currentweek['start']['y']."-".$currentweek['start']['m']."-".$currentweek['start']['d']." 00:00:00") - (3600 * $GMT);
                $fix2 = strtotime($currentweek['end']['y']."-".$currentweek['end']['m']."-".$currentweek['end']['d']." 23:59:59") - (3600 * $GMT);
                $tt_start = date("Y-m-d ",$fix).date("H",$fix).":".date("i",$fix).":".date("s",$fix);
                $tt_end = date("Y-m-d ",$fix2).date("H",$fix2).":".date("i",$fix2).":".date("s",$fix2);
            } else {
                $tt_start = date("Y-m-d H:i:s",strtotime($currentweek['start']['y']."-".$currentweek['start']['m']."-".$currentweek['start']['d']." 00:00:00"));
                $tt_end = date("Y-m-d H:i:s",strtotime($currentweek['end']['y']."-".$currentweek['end']['m']."-".$currentweek['end']['d']." 23:59:59"));
            }

    		if ($this->session->is_super_user == 1) {

    			$sql = "SELECT e.name as ename,u.nickname as manager_name, e.date as `date`, e.comment as comment, c.name as cname, c.id as id FROM `dacons_events` as e " .
    				   "LEFT JOIN `dacons_companies` as c on c.id = e.company_id " .
                       "LEFT JOIN `dacons_users` as u ON c.manager = u.id WHERE " .
    				   "e.date >= '$tt_start' " .
    				   "AND e.date <'$tt_end' " .
    				   "AND c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ";

    			if ($manager != -1) {
    				$sql .= "AND c.manager = '$manager' ";
    			}

    			$sql .= "ORDER BY e.date";

                //
                $sql2 = "SELECT DISTINCT e.date as `date` FROM `dacons_events` as e " .
                       "LEFT JOIN `dacons_companies` as c on c.id = e.company_id WHERE " .
                       "c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ";

                if ($manager != -1) {
                    $sql2 .= "AND c.manager = '$manager' ";
                }

                $temp = $this->db->fetchCol($sql2);
                foreach ($temp as $k => $v) {
                    $temp[$k] = date("j.n.Y",strtotime($temp[$k]) + (3600 * $GMT));
                }
                $this->view->json = Zend_Json::encode($temp);

    		} else {

    			$sql = "SELECT e.name as ename, e.date as `date`, e.comment as comment, c.name as cname, c.id as id FROM `dacons_events` as e " .
    				   "LEFT JOIN `dacons_companies` as c on c.id = e.company_id WHERE " .
    				   "e.date >= '$tt_start' " .
    				   "AND e.date <'$tt_end' " .
    				   "AND c.manager = '".$this->session->id."' " .
                       "ORDER BY e.date";

                $sql2 = "SELECT DISTINCT e.date as `date` FROM `dacons_events` as e " .
                       "LEFT JOIN `dacons_companies` as c on c.id = e.company_id WHERE " .
                       "c.manager = '".$this->session->id."' ";

                $temp = $this->db->fetchCol($sql2);
                foreach ($temp as $k => $v) {
                    $temp[$k] = date("j.n.Y",strtotime($temp[$k]) + (3600 * $GMT));
                }
                $this->view->json = Zend_Json::encode($temp);

    		}

    	} else {

    		$_days = date ("t", mktime (0,0,0,date($fordate['m']+1),0,date($fordate['y'])));

            if ($GMT != 0) {
                $fix = strtotime($fordate["y"]."-".($fordate["m"]+1)."-01 00:00:00") - (3600 * $GMT);
                $fix2 = strtotime($fordate["y"]."-".($fordate["m"]+1)."-$_days 23:59:59") - (3600 * $GMT);
                $tt_start = date("Y-m-d ",$fix).date("H",$fix).":".date("i",$fix).":".date("s",$fix);
                $tt_end = date("Y-m-d ",$fix2).date("H",$fix2).":".date("i",$fix2).":".date("s",$fix2);
            } else {
                $tt_start = date("Y-m-d H:i:s",strtotime($fordate["y"]."-".($fordate["m"]+1)."-01 00:00:00")); //-01 00:00:00
                //$tt_end = date("Y-m-d H:i:s",strtotime($fordate["y"]."-".($fordate["m"]+1)."-".($_days-1)." 23:59:59"));
		switch ($fordate ['m']+1) {
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				$__days = 31;break;
			case 2: $__days = ($fordate['y'] % 4 != 0) ? 28 : 29;break;
			default: $__days = 30;
		}
		$tt_end = date("Y-m-d H:i:s",strtotime($fordate["y"]."-".($fordate["m"]+1)."-".($__days)." 23:59:59"));
            }

    		if ($this->session->is_super_user == 1) {

    			$sql = "SELECT e.name as ename,u.nickname as manager_name, e.date as `date`, e.comment as comment, c.name as cname, c.id as id FROM `dacons_events` as e " .
    				   "LEFT JOIN `dacons_companies` as c on c.id = e.company_id " .
                       "LEFT JOIN `dacons_users` as u ON c.manager = u.id WHERE " .
    				   "e.date >= '$tt_start' " .
    				   "AND e.date <'$tt_end' " .
    				   "AND c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ";

    			if ($manager != -1) {
    				$sql .= "AND c.manager = '$manager' ";
    			}

    			$sql .= "ORDER BY e.date";
    		} else {
    			$sql = "SELECT e.name as ename, e.date as `date`, e.comment as comment, c.name as cname, c.id as id FROM `dacons_events` as e " .
    				   "LEFT JOIN `dacons_companies` as c on c.id = e.company_id WHERE " .
    				   "e.date >= '$tt_start' " .
    				   "AND e.date <'$tt_end' " .
    				   "AND c.manager = '".$this->session->id."' " .
                       "ORDER BY e.date";
    		}

    	}
    	$temp = $this->db->fetchAll($sql);

        if ($this->session->is_super_user == 1) {
        $sql_count = "SELECT count(*) as cnt, c.manager FROM `dacons_events` as e " .
                     "LEFT JOIN `dacons_companies` as c on c.id = e.company_id " .
                     "LEFT JOIN `dacons_users` as u ON c.manager = u.id WHERE " .
                     "e.date >= '$tt_start' " .
                     "AND e.date <'$tt_end' " .
                     "AND c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') " .
                     "GROUP BY c.manager";

        $this->eventCountByManagers($this->db->fetchAll($sql_count));
        }

        if ($GMT != 0) {
            foreach ($temp as $k => $v) {
                $temp[$k]['date'] = date("Y-m-d H:i:s",strtotime($temp[$k]['date']) + (3600 * $GMT));
            }
        }
        $this->view->journaldata = $temp;
        //<encoder_end>

    }

    private function eventCountByManagers($data) {
        $temp = $this->view->managers;
        foreach ($temp as $k => $v) {

            foreach ($data as $k2 => $v2) {
                if ($v2['manager']==$v['id']) {
                    $temp[$k]['cnt'] = $v2['cnt'];
                }
            }

        }
        $this->view->managers = $temp;
    }

}

?>
