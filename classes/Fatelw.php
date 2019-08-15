<?php namespace Synoptica\Order\Classes;

class Fatelw {
    
    static private $service = 'https://digitalhub2.zucchetti.it/fatelw/services/fatelwV1?wsdl';
    static private $client;
    static private $token;
    static private $error;

    static private function check(){
        if (!self::$client){
            self::$client = new SoapClient(self::$service);
        }
        if (!self::$token){
            $connect = self::$client->connect(FATELW_USERNAME, FATELW_PASSWORD, FATELW_COMPANY);
            if ($connect->code==0){
                self::$token = $connect->token;
            } else {
                $error = $connect;
            }
        }
    }

    static private function elab($result){
        self::$token = $result->token;

        if ($result->code==0){
            
        } else {
        
        }

        return $result->response;
    }

    static public function sendDocument($filename, $filecontent, $filehash, $descriptor, $descriptorhash, $isLast=true){
        self::check();
        return self::elab(self::$client->sendDocument(self::$token, $filename, $filecontent, $filehash, $descriptor, $descriptorhash, $isLast=true));
    }

    static public function getState($id){
        self::check();
        return self::elab(self::$client->getState(self::$token, $id));
    }

    static public function valDocument($id){
        self::check();
        return self::elab(self::$client->valDocument(self::$token, $id));
    }

    static public function signAndConfirmDocument($id){
        self::check();
        return self::elab(self::$client->signAndConfirmDocument(self::$token, $id));
    }
    

}

/*

Servizi FatelwV1

    [0] => fatelwV1Return connect(string $userName, string $password, string $company)
    [1] => fatelwV1Return disconnect(string $token)
    [2] => fatelwV1Return getCedente(string $token, string $idPaese, string $idCodice)
    [3] => fatelwV1Return insCedente(string $token, string $idPaese, string $idCodice, fatelwV1Cedente $cedente)
    [4] => fatelwV1Return updCedente(string $token, string $idPaese, string $idCodice, fatelwV1Cedente $cedente)
    [5] => fatelwV1Return updCedenteProgInvio(string $token, string $idPaese, string $idCodice, fatelwV1Cedente $cedente, string $progressivoInvio)
    [6] => fatelwV1Return insConsumi(string $token, string $idPaese, string $idCodice, int $anno, int $qta)
    [7] => fatelwV1Return getAziMaster(string $token)
    [8] => fatelwV1Return getConsumi(string $token, string $year, string $idPaese, string $idCodice)
    [9] => fatelwV1Return getConsumiByMonth(string $token, string $year, string $month, string $idPaese, string $idCodice)
    [10] => fatelwV1Return insFatture(string $token, string $idAzienda, int $quantita, string $prodotto)
    [11] => fatelwV1Return insSubfornitura(string $token, string $idPaese, string $idCodice, fatelwV1Cedente $cedente, string $invioCredenziali)
    [12] => fatelwV1Return updSubfornitura(string $token, string $idPaese, string $idCodice, fatelwV1Cedente $cedente, string $invioCredenziali)
    [13] => fatelwV1Return billing_pwdchange(string $token, string $amCodice, string $MailAddress, string $target, string $user, string $password)
    [14] => fatelwV1Return billing_pwdchange_partner(string $token, string $CodiceSige, string $MailAddress, string $password)
    [15] => fatelwV1Return getUtente(string $userName, string $password)
    [16] => fatelwV1Return getHub(string $userName, string $password)
    [17] => fatelwV1Return getState(string $token, ArrayOf_xsd_string $id)
    [18] => fatelwV1Return delDocument(string $token, string $id)
    [19] => fatelwV1Return getDocuments(string $token, ArrayOf_xsd_string $id)
    [20] => fatelwV1Return getDocumentFile(string $token, string $id)
    [21] => fatelwV1Return getNotificationFile(string $token, string $id, string $file)
    [22] => fatelwV1Return getDocumentFiles(string $token, string $id)
    [23] => fatelwV1Return getDocumentFilesAttach(string $token, string $id)
    [24] => fatelwV1Return getDocumentsFiles(string $token, ArrayOf_xsd_string $ids, boolean $unsignP7M)
    [25] => fatelwV1Return getDocumentsFilesFP(string $token, ArrayOf_xsd_string $ids, boolean $unsignP7M)
    [26] => fatelwV1Return getDocumentsList(string $token, string $dateFrom, string $dateTo, string $idPaese, string $idCodice, string $codiceFiscale, string $stato)
    [27] => fatelwV1Return valDocument(string $token, ArrayOf_xsd_string $id)
    [28] => fatelwV1Return signDocument(string $token, ArrayOf_xsd_string $id)
    [29] => fatelwV1Return signDocumentService(string $token, ArrayOf_xsd_string $id, string $signService)
    [30] => fatelwV1Return signAndConfirmDocument(string $token, ArrayOf_xsd_string $id)
    [31] => fatelwV1Return signAndConfirmDocumentService(string $token, ArrayOf_xsd_string $id, string $signService)
    [32] => fatelwV1Return confDocument(string $token, ArrayOf_xsd_string $id)
    [33] => fatelwV1Return setCompleted(string $token, ArrayOf_xsd_string $id)
    [34] => fatelwV1Return sendDocument(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, base64Binary $descriptor, base64Binary $hashDescriptor, boolean $isLast)
    [35] => fatelwV1Return sendDocumentsAsync(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, boolean $isLast)
    [36] => fatelwV1Return sendDocuments(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, boolean $isLast)
    [37] => fatelwV1Return getEsitoImport(string $token, string $fileName)
    [38] => fatelwV1Return getStateFP(string $token, ArrayOf_xsd_string $id)
    [39] => fatelwV1Return getDocumentsFP(string $token, ArrayOf_xsd_string $id)
    [40] => fatelwV1Return getDocumentFileFP(string $token, string $id, string $idUserExt, boolean $unsignP7M)
    [41] => fatelwV1Return getDocumentFilesFP(string $token, string $id, string $idUserExt, boolean $unsignP7M)
    [42] => fatelwV1Return getDocumentFilesAttachFP(string $token, string $id, string $idUserExt, boolean $unsignP7M)
    [43] => fatelwV1Return getDocumentsListFP(string $token, boolean $allDocuments, string $dateFrom, string $dateTo, string $idCessionario)
    [44] => fatelwV1Return getDocumentsListFPCD(string $token, boolean $allDocuments, string $dateFrom, string $dateTo, string $idCessionario, string $codiceDestinatario)
    [45] => fatelwV1Return getDocumentsListFPHMS(string $token, boolean $allDocuments, string $dateFromhms, string $dateTohms, string $idCessionario, string $codiceDestinatario)
    [46] => fatelwV1Return getNotificationFileFP(string $token, string $id, string $file, string $idUserExt)
    [47] => fatelwV1Return genNotifyFP(string $token, ArrayOf_xsd_string $id, string $tipoNotifica, string $motivo, string $idCessionario)
    [48] => fatelwV1Return getFatturaFile(string $token, string $id, int $position)
    [49] => fatelwV1Return sendDocumentFP(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, base64Binary $descriptor, base64Binary $hashDescriptor, boolean $isLast, string $stato)
    [50] => fatelwV1Return sendDocumentsFP(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, boolean $isLast, string $stato)
    [51] => fatelwV1Return getStateDF(string $token, ArrayOf_xsd_string $id)
    [52] => fatelwV1Return delDocumentDF(string $token, string $id)
    [53] => fatelwV1Return getDocumentsDF(string $token, ArrayOf_xsd_string $id)
    [54] => fatelwV1Return getDocumentFileDF(string $token, string $id)
    [55] => fatelwV1Return getNotificationFileDF(string $token, string $id, string $file)
    [56] => fatelwV1Return getDocumentFilesDF(string $token, string $id)
    [57] => fatelwV1Return valDocumentDF(string $token, ArrayOf_xsd_string $id)
    [58] => fatelwV1Return chkDocumentDF(string $token, string $fileName, base64Binary $file, base64Binary $hashFile)
    [59] => fatelwV1Return signDocumentDF(string $token, ArrayOf_xsd_string $id, string $signService)
    [60] => fatelwV1Return signAndConfirmDocumentDF(string $token, ArrayOf_xsd_string $id, string $signService)
    [61] => fatelwV1Return confDocumentDF(string $token, ArrayOf_xsd_string $id)
    [62] => fatelwV1Return sendDocumentDF(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, base64Binary $descriptor, base64Binary $hashDescriptor, boolean $isLast)
    [63] => fatelwV1Return sendDocumentsDF(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, boolean $isLast)
    [64] => fatelwV1Return getStateLI(string $token, ArrayOf_xsd_string $id)
    [65] => fatelwV1Return delDocumentLI(string $token, string $id)
    [66] => fatelwV1Return getDocumentsLI(string $token, ArrayOf_xsd_string $id)
    [67] => fatelwV1Return getDocumentFileLI(string $token, string $id)
    [68] => fatelwV1Return getNotificationFileLI(string $token, string $id, string $file)
    [69] => fatelwV1Return getDocumentFilesLI(string $token, string $id)
    [70] => fatelwV1Return valDocumentLI(string $token, ArrayOf_xsd_string $id)
    [71] => fatelwV1Return chkDocumentLI(string $token, string $fileName, base64Binary $file, base64Binary $hashFile)
    [72] => fatelwV1Return signDocumentLI(string $token, ArrayOf_xsd_string $id, string $signService)
    [73] => fatelwV1Return signAndConfirmDocumentLI(string $token, ArrayOf_xsd_string $id, string $signService)
    [74] => fatelwV1Return confDocumentLI(string $token, ArrayOf_xsd_string $id)
    [75] => fatelwV1Return sendDocumentLI(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, base64Binary $descriptor, base64Binary $hashDescriptor, boolean $isLast)
    [76] => fatelwV1Return sendDocumentsLI(string $token, string $fileName, base64Binary $file, base64Binary $hashFile, boolean $isLast)
)
*/