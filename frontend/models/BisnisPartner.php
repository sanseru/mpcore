<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "BisnisPartner".
 *
 * @property string $CardCode
 * @property string|null $CardName
 * @property string|null $CardType
 * @property int|null $GroupCode
 * @property string|null $CmpPrivate
 * @property string|null $Address
 * @property string|null $ZipCode
 * @property string|null $MailAddres
 * @property string|null $MailZipCod
 * @property string|null $Phone1
 * @property string|null $Phone2
 * @property string|null $Fax
 * @property string|null $CntctPrsn
 * @property string|null $Notes
 * @property float|null $Balance
 * @property float|null $ChecksBal
 * @property float|null $DNotesBal
 * @property float|null $OrdersBal
 * @property int|null $GroupNum
 * @property float|null $CreditLine
 * @property float|null $DebtLine
 * @property float|null $Discount
 * @property string|null $VatStatus
 * @property string|null $LicTradNum
 * @property string|null $DdctStatus
 * @property float|null $DdctPrcnt
 * @property string|null $ValidUntil
 * @property int|null $Chrctrstcs
 * @property int|null $ExMatchNum
 * @property int|null $InMatchNum
 * @property int|null $ListNum
 * @property float|null $DNoteBalFC
 * @property float|null $OrderBalFC
 * @property float|null $DNoteBalSy
 * @property float|null $OrderBalSy
 * @property string|null $Transfered
 * @property string|null $BalTrnsfrd
 * @property float|null $IntrstRate
 * @property float|null $Commission
 * @property int|null $CommGrCode
 * @property string|null $Free_Text
 * @property int|null $SlpCode
 * @property string|null $PrevYearAc
 * @property string|null $Currency
 * @property string|null $RateDifAct
 * @property float|null $BalanceSys
 * @property float|null $BalanceFC
 * @property string|null $Protected
 * @property string|null $Cellular
 * @property int|null $AvrageLate
 * @property string|null $City
 * @property string|null $County
 * @property string|null $Country
 * @property string|null $MailCity
 * @property string|null $MailCounty
 * @property string|null $MailCountr
 * @property string|null $E_Mail
 * @property string|null $Picture
 * @property string|null $DflAccount
 * @property string|null $DflBranch
 * @property string|null $BankCode
 * @property string|null $AddID
 * @property string|null $Pager
 * @property string|null $FatherCard
 * @property string|null $CardFName
 * @property string|null $FatherType
 * @property string|null $QryGroup1
 * @property string|null $QryGroup2
 * @property string|null $QryGroup3
 * @property string|null $QryGroup4
 * @property string|null $QryGroup5
 * @property string|null $QryGroup6
 * @property string|null $QryGroup7
 * @property string|null $QryGroup8
 * @property string|null $QryGroup9
 * @property string|null $QryGroup10
 * @property string|null $QryGroup11
 * @property string|null $QryGroup12
 * @property string|null $QryGroup13
 * @property string|null $QryGroup14
 * @property string|null $QryGroup15
 * @property string|null $QryGroup16
 * @property string|null $QryGroup17
 * @property string|null $QryGroup18
 * @property string|null $QryGroup19
 * @property string|null $QryGroup20
 * @property string|null $QryGroup21
 * @property string|null $QryGroup22
 * @property string|null $QryGroup23
 * @property string|null $QryGroup24
 * @property string|null $QryGroup25
 * @property string|null $QryGroup26
 * @property string|null $QryGroup27
 * @property string|null $QryGroup28
 * @property string|null $QryGroup29
 * @property string|null $QryGroup30
 * @property string|null $QryGroup31
 * @property string|null $QryGroup32
 * @property string|null $QryGroup33
 * @property string|null $QryGroup34
 * @property string|null $QryGroup35
 * @property string|null $QryGroup36
 * @property string|null $QryGroup37
 * @property string|null $QryGroup38
 * @property string|null $QryGroup39
 * @property string|null $QryGroup40
 * @property string|null $QryGroup41
 * @property string|null $QryGroup42
 * @property string|null $QryGroup43
 * @property string|null $QryGroup44
 * @property string|null $QryGroup45
 * @property string|null $QryGroup46
 * @property string|null $QryGroup47
 * @property string|null $QryGroup48
 * @property string|null $QryGroup49
 * @property string|null $QryGroup50
 * @property string|null $QryGroup51
 * @property string|null $QryGroup52
 * @property string|null $QryGroup53
 * @property string|null $QryGroup54
 * @property string|null $QryGroup55
 * @property string|null $QryGroup56
 * @property string|null $QryGroup57
 * @property string|null $QryGroup58
 * @property string|null $QryGroup59
 * @property string|null $QryGroup60
 * @property string|null $QryGroup61
 * @property string|null $QryGroup62
 * @property string|null $QryGroup63
 * @property string|null $QryGroup64
 * @property string|null $DdctOffice
 * @property string|null $CreateDate
 * @property string|null $UpdateDate
 * @property string|null $ExportCode
 * @property int|null $DscntObjct
 * @property string|null $DscntRel
 * @property int|null $SPGCounter
 * @property int|null $SPPCounter
 * @property string|null $DdctFileNo
 * @property int|null $SCNCounter
 * @property float|null $MinIntrst
 * @property string|null $DataSource
 * @property int|null $OprCount
 * @property string|null $ExemptNo
 * @property int|null $Priority
 * @property int|null $CreditCard
 * @property string|null $CrCardNum
 * @property string|null $CardValid
 * @property int|null $UserSign
 * @property string|null $LocMth
 * @property string|null $validFor
 * @property string|null $validFrom
 * @property string|null $validTo
 * @property string|null $frozenFor
 * @property string|null $frozenFrom
 * @property string|null $frozenTo
 * @property string|null $sEmployed
 * @property int|null $MTHCounter
 * @property int|null $BNKCounter
 * @property int|null $DdgKey
 * @property int|null $DdtKey
 * @property string|null $ValidComm
 * @property string|null $FrozenComm
 * @property string|null $chainStore
 * @property string|null $DiscInRet
 * @property string|null $State1
 * @property string|null $State2
 * @property string|null $VatGroup
 * @property int|null $LogInstanc
 * @property string|null $ObjType
 * @property string|null $Indicator
 * @property int|null $ShipType
 * @property string|null $DebPayAcct
 * @property string|null $ShipToDef
 * @property string|null $Block
 * @property string|null $MailBlock
 * @property string|null $Password
 * @property string|null $ECVatGroup
 * @property string|null $Deleted
 * @property string|null $IBAN
 * @property int $DocEntry
 * @property int|null $FormCode
 * @property string|null $Box1099
 * @property string|null $PymCode
 * @property string|null $BackOrder
 * @property string|null $PartDelivr
 * @property int|null $DunnLevel
 * @property string|null $DunnDate
 * @property string|null $BlockDunn
 * @property string|null $BankCountr
 * @property string|null $CollecAuth
 * @property string|null $DME
 * @property string|null $InstrucKey
 * @property string|null $SinglePaym
 * @property string|null $ISRBillId
 * @property string|null $PaymBlock
 * @property string|null $RefDetails
 * @property string|null $HouseBank
 * @property string|null $OwnerIdNum
 * @property int|null $PyBlckDesc
 * @property string|null $HousBnkCry
 * @property string|null $HousBnkAct
 * @property string|null $HousBnkBrn
 * @property string|null $ProjectCod
 * @property int|null $SysMatchNo
 * @property string|null $VatIdUnCmp
 * @property string|null $AgentCode
 * @property int|null $TolrncDays
 * @property string|null $SelfInvoic
 * @property string|null $DeferrTax
 * @property string|null $LetterNum
 * @property float|null $MaxAmount
 * @property string|null $FromDate
 * @property string|null $ToDate
 * @property string|null $WTLiable
 * @property string|null $CrtfcateNO
 * @property string|null $ExpireDate
 * @property string|null $NINum
 * @property string|null $AccCritria
 * @property string|null $WTCode
 * @property string|null $Equ
 * @property string|null $HldCode
 * @property string|null $ConnBP
 * @property int|null $MltMthNum
 * @property string|null $TypWTReprt
 * @property string|null $VATRegNum
 * @property string|null $RepName
 * @property string|null $Industry
 * @property string|null $Business
 * @property string|null $WTTaxCat
 * @property string|null $IsDomestic
 * @property string|null $IsResident
 * @property string|null $AutoCalBCG
 * @property string|null $OtrCtlAcct
 * @property string|null $AliasName
 * @property string|null $Building
 * @property string|null $MailBuildi
 * @property string|null $BoEPrsnt
 * @property string|null $BoEDiscnt
 * @property string|null $BoEOnClct
 * @property string|null $UnpaidBoE
 * @property string|null $ITWTCode
 * @property string|null $DunTerm
 * @property string|null $ChannlBP
 * @property int|null $DfTcnician
 * @property int|null $Territory
 * @property string|null $BillToDef
 * @property string|null $DpmClear
 * @property string|null $IntrntSite
 * @property int|null $LangCode
 * @property int|null $HousActKey
 * @property string|null $Profession
 * @property int|null $CDPNum
 * @property int|null $DflBankKey
 * @property string|null $BCACode
 * @property string|null $UseShpdGd
 * @property string|null $RegNum
 * @property string|null $VerifNum
 * @property string|null $BankCtlKey
 * @property string|null $HousCtlKey
 * @property string|null $AddrType
 * @property string|null $InsurOp347
 * @property string|null $MailAddrTy
 * @property string|null $StreetNo
 * @property string|null $MailStrNo
 * @property string|null $TaxRndRule
 * @property int|null $VendTID
 * @property string|null $ThreshOver
 * @property string|null $SurOver
 * @property string|null $VendorOcup
 * @property string|null $OpCode347
 * @property string|null $DpmIntAct
 * @property string|null $ResidenNum
 * @property int|null $UserSign2
 * @property string|null $PlngGroup
 * @property string|null $VatIDNum
 * @property string|null $Affiliate
 * @property string|null $MivzExpSts
 * @property string|null $HierchDdct
 * @property string|null $CertWHT
 * @property string|null $CertBKeep
 * @property string|null $WHShaamGrp
 * @property int|null $IndustryC
 * @property string|null $DatevAcct
 * @property string|null $DatevFirst
 * @property string|null $GTSRegNum
 * @property string|null $GTSBankAct
 * @property string|null $GTSBilAddr
 * @property string|null $HsBnkSwift
 * @property string|null $HsBnkIBAN
 * @property string|null $DflSwift
 * @property string|null $AutoPost
 * @property string|null $IntrAcc
 * @property string|null $FeeAcc
 * @property int|null $CpnNo
 * @property int|null $NTSWebSite
 * @property string|null $DflIBAN
 * @property int|null $Series
 * @property int|null $Number
 * @property int|null $EDocExpFrm
 * @property string|null $TaxIdIdent
 * @property string|null $Attachment
 * @property int|null $AtcEntry
 * @property string|null $DiscRel
 * @property string|null $NoDiscount
 * @property string|null $SCAdjust
 * @property int|null $DflAgrmnt
 * @property string|null $GlblLocNum
 * @property string|null $SenderID
 * @property string|null $RcpntID
 * @property int|null $MainUsage
 * @property string|null $SefazCheck
 * @property string|null $free312
 * @property string|null $free313
 * @property string|null $DateFrom
 * @property string|null $DateTill
 * @property string|null $RelCode
 * @property string|null $OKATO
 * @property string|null $OKTMO
 * @property string|null $KBKCode
 * @property string|null $TypeOfOp
 * @property int|null $OwnerCode
 * @property string|null $MandateID
 * @property string|null $SignDate
 * @property int|null $Remark1
 * @property string|null $ConCerti
 * @property int|null $TpCusPres
 * @property string|null $RoleTypCod
 * @property string|null $BlockComm
 * @property string|null $EmplymntCt
 * @property string|null $ExcptnlEvt
 * @property float|null $ExpnPrfFnd
 * @property string|null $EdrsFromBP
 * @property string|null $EdrsToBP
 * @property int|null $CreateTS
 * @property int|null $UpdateTS
 * @property string|null $EDocGenTyp
 * @property string|null $eStreet
 * @property string|null $eStreetNum
 * @property int|null $eBuildnNum
 * @property string|null $eZipCode
 * @property string|null $eCityTown
 * @property string|null $eCountry
 * @property string|null $eDistrict
 * @property string|null $RepFName
 * @property string|null $RepSName
 * @property string|null $RepCmpName
 * @property string|null $RepFisCode
 * @property string|null $RepAddID
 * @property string|null $PECAddr
 * @property string|null $IPACodePA
 * @property string|null $PriceMode
 * @property string|null $EffecPrice
 * @property string|null $TxExMxVdTp
 * @property string|null $MerchantID
 * @property string|null $UseBilAddr
 * @property string|null $NaturalPer
 * @property string|null $DPPStatus
 * @property string|null $EnAddID
 * @property string|null $EncryptIV
 * @property string|null $EnDflAccnt
 * @property string|null $EnDflIBAN
 * @property string|null $U_SOL_REGULAR
 * @property string|null $U_SOL_MEDICAL
 * @property string|null $U_SOL_KODLAM
 * @property string|null $U_SOL_ALAMAT_NPWP
 * @property string|null $U_SOL_NAMA_NPWP
 * @property string|null $U_SOL_VIRACC
 * @property string|null $U_SOL_COB_DATE
 * @property int|null $U_SOL_COB_TIME
 * @property string|null $U_SOL_COB_DAY
 */
class BisnisPartner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'BisnisPartner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CardCode', 'DocEntry'], 'required'],
            [['GroupCode', 'GroupNum', 'Chrctrstcs', 'ExMatchNum', 'InMatchNum', 'ListNum', 'CommGrCode', 'SlpCode', 'AvrageLate', 'DscntObjct', 'SPGCounter', 'SPPCounter', 'SCNCounter', 'OprCount', 'Priority', 'CreditCard', 'UserSign', 'MTHCounter', 'BNKCounter', 'DdgKey', 'DdtKey', 'LogInstanc', 'ShipType', 'DocEntry', 'FormCode', 'DunnLevel', 'PyBlckDesc', 'SysMatchNo', 'TolrncDays', 'MltMthNum', 'DfTcnician', 'Territory', 'LangCode', 'HousActKey', 'CDPNum', 'DflBankKey', 'VendTID', 'UserSign2', 'IndustryC', 'CpnNo', 'NTSWebSite', 'Series', 'Number', 'EDocExpFrm', 'AtcEntry', 'DflAgrmnt', 'MainUsage', 'OwnerCode', 'Remark1', 'TpCusPres', 'CreateTS', 'UpdateTS', 'eBuildnNum', 'U_SOL_COB_TIME'], 'integer'],
            [['Balance', 'ChecksBal', 'DNotesBal', 'OrdersBal', 'CreditLine', 'DebtLine', 'Discount', 'DdctPrcnt', 'DNoteBalFC', 'OrderBalFC', 'DNoteBalSy', 'OrderBalSy', 'IntrstRate', 'Commission', 'BalanceSys', 'BalanceFC', 'MinIntrst', 'MaxAmount', 'ExpnPrfFnd'], 'number'],
            [['ValidUntil', 'CreateDate', 'UpdateDate', 'CardValid', 'validFrom', 'validTo', 'frozenFrom', 'frozenTo', 'DunnDate', 'FromDate', 'ToDate', 'ExpireDate', 'DateFrom', 'DateTill', 'SignDate', 'U_SOL_COB_DATE'], 'safe'],
            [['Free_Text', 'Industry', 'Business', 'WTTaxCat', 'AliasName', 'Building', 'MailBuildi', 'Attachment', 'EnAddID', 'EnDflAccnt', 'EnDflIBAN'], 'string'],
            [['CardCode', 'RateDifAct', 'FatherCard', 'DebPayAcct', 'PymCode', 'OwnerIdNum', 'ConnBP', 'RepName', 'OtrCtlAcct', 'BoEPrsnt', 'BoEDiscnt', 'BoEOnClct', 'UnpaidBoE', 'ChannlBP', 'DpmClear', 'VendorOcup', 'DpmIntAct', 'IntrAcc', 'FeeAcc', 'MerchantID'], 'string', 'max' => 15],
            [['CardName', 'Address', 'MailAddres', 'Notes', 'City', 'County', 'MailCity', 'MailCounty', 'E_Mail', 'CardFName', 'Block', 'MailBlock', 'IntrntSite', 'AddrType', 'MailAddrTy', 'StreetNo', 'MailStrNo', 'EncryptIV', 'U_SOL_NAMA_NPWP'], 'string', 'max' => 100],
            [['CardType', 'CmpPrivate', 'VatStatus', 'DdctStatus', 'Transfered', 'BalTrnsfrd', 'PrevYearAc', 'Protected', 'FatherType', 'QryGroup1', 'QryGroup2', 'QryGroup3', 'QryGroup4', 'QryGroup5', 'QryGroup6', 'QryGroup7', 'QryGroup8', 'QryGroup9', 'QryGroup10', 'QryGroup11', 'QryGroup12', 'QryGroup13', 'QryGroup14', 'QryGroup15', 'QryGroup16', 'QryGroup17', 'QryGroup18', 'QryGroup19', 'QryGroup20', 'QryGroup21', 'QryGroup22', 'QryGroup23', 'QryGroup24', 'QryGroup25', 'QryGroup26', 'QryGroup27', 'QryGroup28', 'QryGroup29', 'QryGroup30', 'QryGroup31', 'QryGroup32', 'QryGroup33', 'QryGroup34', 'QryGroup35', 'QryGroup36', 'QryGroup37', 'QryGroup38', 'QryGroup39', 'QryGroup40', 'QryGroup41', 'QryGroup42', 'QryGroup43', 'QryGroup44', 'QryGroup45', 'QryGroup46', 'QryGroup47', 'QryGroup48', 'QryGroup49', 'QryGroup50', 'QryGroup51', 'QryGroup52', 'QryGroup53', 'QryGroup54', 'QryGroup55', 'QryGroup56', 'QryGroup57', 'QryGroup58', 'QryGroup59', 'QryGroup60', 'QryGroup61', 'QryGroup62', 'QryGroup63', 'QryGroup64', 'DscntRel', 'DataSource', 'LocMth', 'validFor', 'frozenFor', 'sEmployed', 'chainStore', 'DiscInRet', 'Deleted', 'BackOrder', 'PartDelivr', 'BlockDunn', 'CollecAuth', 'SinglePaym', 'PaymBlock', 'SelfInvoic', 'DeferrTax', 'WTLiable', 'AccCritria', 'Equ', 'TypWTReprt', 'IsDomestic', 'IsResident', 'AutoCalBCG', 'UseShpdGd', 'InsurOp347', 'TaxRndRule', 'ThreshOver', 'SurOver', 'OpCode347', 'ResidenNum', 'Affiliate', 'MivzExpSts', 'HierchDdct', 'CertWHT', 'CertBKeep', 'WHShaamGrp', 'DatevFirst', 'AutoPost', 'TaxIdIdent', 'DiscRel', 'NoDiscount', 'SCAdjust', 'SefazCheck', 'free312', 'free313', 'TypeOfOp', 'BlockComm', 'ExcptnlEvt', 'EdrsFromBP', 'EdrsToBP', 'EDocGenTyp', 'PriceMode', 'EffecPrice', 'TxExMxVdTp', 'UseBilAddr', 'NaturalPer', 'DPPStatus'], 'string', 'max' => 1],
            [['ZipCode', 'MailZipCod', 'Phone1', 'Phone2', 'Fax', 'ObjType', 'Box1099', 'RefDetails', 'ProjectCod', 'LetterNum', 'CrtfcateNO', 'NINum', 'HldCode', 'GTSRegNum', 'KBKCode', 'ConCerti', 'RepFName', 'U_SOL_KODLAM', 'U_SOL_COB_DAY'], 'string', 'max' => 20],
            [['CntctPrsn'], 'string', 'max' => 90],
            [['LicTradNum', 'Password', 'VatIdUnCmp', 'AgentCode', 'VATRegNum', 'RegNum', 'VerifNum', 'VatIDNum', 'IPACodePA'], 'string', 'max' => 32],
            [['Currency', 'Country', 'MailCountr', 'State1', 'State2', 'BankCountr', 'HousBnkCry', 'BCACode', 'eCountry', 'eDistrict'], 'string', 'max' => 3],
            [['Cellular', 'DflAccount', 'DflBranch', 'ExemptNo', 'ShipToDef', 'IBAN', 'HousBnkAct', 'HousBnkBrn', 'BillToDef', 'Profession', 'HsBnkSwift', 'HsBnkIBAN', 'DflSwift', 'DflIBAN', 'GlblLocNum', 'SenderID', 'RcpntID'], 'string', 'max' => 50],
            [['Picture'], 'string', 'max' => 200],
            [['BankCode', 'Pager', 'ValidComm', 'FrozenComm', 'InstrucKey', 'HouseBank'], 'string', 'max' => 30],
            [['AddID', 'CrCardNum'], 'string', 'max' => 64],
            [['DdctOffice', 'PlngGroup', 'eZipCode'], 'string', 'max' => 10],
            [['ExportCode', 'VatGroup', 'ECVatGroup'], 'string', 'max' => 8],
            [['DdctFileNo', 'ISRBillId', 'DatevAcct'], 'string', 'max' => 9],
            [['Indicator', 'BankCtlKey', 'HousCtlKey', 'RelCode', 'RoleTypCod', 'EmplymntCt', 'U_SOL_REGULAR', 'U_SOL_MEDICAL'], 'string', 'max' => 2],
            [['DME'], 'string', 'max' => 5],
            [['WTCode', 'ITWTCode', 'eStreetNum'], 'string', 'max' => 4],
            [['DunTerm', 'U_SOL_VIRACC'], 'string', 'max' => 25],
            [['GTSBankAct', 'GTSBilAddr'], 'string', 'max' => 80],
            [['OKATO'], 'string', 'max' => 11],
            [['OKTMO'], 'string', 'max' => 12],
            [['MandateID'], 'string', 'max' => 35],
            [['eStreet'], 'string', 'max' => 38],
            [['eCityTown'], 'string', 'max' => 48],
            [['RepSName', 'RepCmpName'], 'string', 'max' => 36],
            [['RepFisCode'], 'string', 'max' => 16],
            [['RepAddID'], 'string', 'max' => 28],
            [['PECAddr', 'U_SOL_ALAMAT_NPWP'], 'string', 'max' => 254],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CardCode' => 'Card Code',
            'CardName' => 'Card Name',
            'CardType' => 'Card Type',
            'GroupCode' => 'Group Code',
            'CmpPrivate' => 'Cmp Private',
            'Address' => 'Address',
            'ZipCode' => 'Zip Code',
            'MailAddres' => 'Mail Addres',
            'MailZipCod' => 'Mail Zip Cod',
            'Phone1' => 'Phone1',
            'Phone2' => 'Phone2',
            'Fax' => 'Fax',
            'CntctPrsn' => 'Cntct Prsn',
            'Notes' => 'Notes',
            'Balance' => 'Balance',
            'ChecksBal' => 'Checks Bal',
            'DNotesBal' => 'D Notes Bal',
            'OrdersBal' => 'Orders Bal',
            'GroupNum' => 'Group Num',
            'CreditLine' => 'Credit Line',
            'DebtLine' => 'Debt Line',
            'Discount' => 'Discount',
            'VatStatus' => 'Vat Status',
            'LicTradNum' => 'Lic Trad Num',
            'DdctStatus' => 'Ddct Status',
            'DdctPrcnt' => 'Ddct Prcnt',
            'ValidUntil' => 'Valid Until',
            'Chrctrstcs' => 'Chrctrstcs',
            'ExMatchNum' => 'Ex Match Num',
            'InMatchNum' => 'In Match Num',
            'ListNum' => 'List Num',
            'DNoteBalFC' => 'D Note Bal Fc',
            'OrderBalFC' => 'Order Bal Fc',
            'DNoteBalSy' => 'D Note Bal Sy',
            'OrderBalSy' => 'Order Bal Sy',
            'Transfered' => 'Transfered',
            'BalTrnsfrd' => 'Bal Trnsfrd',
            'IntrstRate' => 'Intrst Rate',
            'Commission' => 'Commission',
            'CommGrCode' => 'Comm Gr Code',
            'Free_Text' => 'Free Text',
            'SlpCode' => 'Slp Code',
            'PrevYearAc' => 'Prev Year Ac',
            'Currency' => 'Currency',
            'RateDifAct' => 'Rate Dif Act',
            'BalanceSys' => 'Balance Sys',
            'BalanceFC' => 'Balance Fc',
            'Protected' => 'Protected',
            'Cellular' => 'Cellular',
            'AvrageLate' => 'Avrage Late',
            'City' => 'City',
            'County' => 'County',
            'Country' => 'Country',
            'MailCity' => 'Mail City',
            'MailCounty' => 'Mail County',
            'MailCountr' => 'Mail Countr',
            'E_Mail' => 'E Mail',
            'Picture' => 'Picture',
            'DflAccount' => 'Dfl Account',
            'DflBranch' => 'Dfl Branch',
            'BankCode' => 'Bank Code',
            'AddID' => 'Add ID',
            'Pager' => 'Pager',
            'FatherCard' => 'Father Card',
            'CardFName' => 'Card F Name',
            'FatherType' => 'Father Type',
            'QryGroup1' => 'Qry Group1',
            'QryGroup2' => 'Qry Group2',
            'QryGroup3' => 'Qry Group3',
            'QryGroup4' => 'Qry Group4',
            'QryGroup5' => 'Qry Group5',
            'QryGroup6' => 'Qry Group6',
            'QryGroup7' => 'Qry Group7',
            'QryGroup8' => 'Qry Group8',
            'QryGroup9' => 'Qry Group9',
            'QryGroup10' => 'Qry Group10',
            'QryGroup11' => 'Qry Group11',
            'QryGroup12' => 'Qry Group12',
            'QryGroup13' => 'Qry Group13',
            'QryGroup14' => 'Qry Group14',
            'QryGroup15' => 'Qry Group15',
            'QryGroup16' => 'Qry Group16',
            'QryGroup17' => 'Qry Group17',
            'QryGroup18' => 'Qry Group18',
            'QryGroup19' => 'Qry Group19',
            'QryGroup20' => 'Qry Group20',
            'QryGroup21' => 'Qry Group21',
            'QryGroup22' => 'Qry Group22',
            'QryGroup23' => 'Qry Group23',
            'QryGroup24' => 'Qry Group24',
            'QryGroup25' => 'Qry Group25',
            'QryGroup26' => 'Qry Group26',
            'QryGroup27' => 'Qry Group27',
            'QryGroup28' => 'Qry Group28',
            'QryGroup29' => 'Qry Group29',
            'QryGroup30' => 'Qry Group30',
            'QryGroup31' => 'Qry Group31',
            'QryGroup32' => 'Qry Group32',
            'QryGroup33' => 'Qry Group33',
            'QryGroup34' => 'Qry Group34',
            'QryGroup35' => 'Qry Group35',
            'QryGroup36' => 'Qry Group36',
            'QryGroup37' => 'Qry Group37',
            'QryGroup38' => 'Qry Group38',
            'QryGroup39' => 'Qry Group39',
            'QryGroup40' => 'Qry Group40',
            'QryGroup41' => 'Qry Group41',
            'QryGroup42' => 'Qry Group42',
            'QryGroup43' => 'Qry Group43',
            'QryGroup44' => 'Qry Group44',
            'QryGroup45' => 'Qry Group45',
            'QryGroup46' => 'Qry Group46',
            'QryGroup47' => 'Qry Group47',
            'QryGroup48' => 'Qry Group48',
            'QryGroup49' => 'Qry Group49',
            'QryGroup50' => 'Qry Group50',
            'QryGroup51' => 'Qry Group51',
            'QryGroup52' => 'Qry Group52',
            'QryGroup53' => 'Qry Group53',
            'QryGroup54' => 'Qry Group54',
            'QryGroup55' => 'Qry Group55',
            'QryGroup56' => 'Qry Group56',
            'QryGroup57' => 'Qry Group57',
            'QryGroup58' => 'Qry Group58',
            'QryGroup59' => 'Qry Group59',
            'QryGroup60' => 'Qry Group60',
            'QryGroup61' => 'Qry Group61',
            'QryGroup62' => 'Qry Group62',
            'QryGroup63' => 'Qry Group63',
            'QryGroup64' => 'Qry Group64',
            'DdctOffice' => 'Ddct Office',
            'CreateDate' => 'Create Date',
            'UpdateDate' => 'Update Date',
            'ExportCode' => 'Export Code',
            'DscntObjct' => 'Dscnt Objct',
            'DscntRel' => 'Dscnt Rel',
            'SPGCounter' => 'Spg Counter',
            'SPPCounter' => 'Spp Counter',
            'DdctFileNo' => 'Ddct File No',
            'SCNCounter' => 'Scn Counter',
            'MinIntrst' => 'Min Intrst',
            'DataSource' => 'Data Source',
            'OprCount' => 'Opr Count',
            'ExemptNo' => 'Exempt No',
            'Priority' => 'Priority',
            'CreditCard' => 'Credit Card',
            'CrCardNum' => 'Cr Card Num',
            'CardValid' => 'Card Valid',
            'UserSign' => 'User Sign',
            'LocMth' => 'Loc Mth',
            'validFor' => 'Valid For',
            'validFrom' => 'Valid From',
            'validTo' => 'Valid To',
            'frozenFor' => 'Frozen For',
            'frozenFrom' => 'Frozen From',
            'frozenTo' => 'Frozen To',
            'sEmployed' => 'S Employed',
            'MTHCounter' => 'Mth Counter',
            'BNKCounter' => 'Bnk Counter',
            'DdgKey' => 'Ddg Key',
            'DdtKey' => 'Ddt Key',
            'ValidComm' => 'Valid Comm',
            'FrozenComm' => 'Frozen Comm',
            'chainStore' => 'Chain Store',
            'DiscInRet' => 'Disc In Ret',
            'State1' => 'State1',
            'State2' => 'State2',
            'VatGroup' => 'Vat Group',
            'LogInstanc' => 'Log Instanc',
            'ObjType' => 'Obj Type',
            'Indicator' => 'Indicator',
            'ShipType' => 'Ship Type',
            'DebPayAcct' => 'Deb Pay Acct',
            'ShipToDef' => 'Ship To Def',
            'Block' => 'Block',
            'MailBlock' => 'Mail Block',
            'Password' => 'Password',
            'ECVatGroup' => 'Ec Vat Group',
            'Deleted' => 'Deleted',
            'IBAN' => 'Iban',
            'DocEntry' => 'Doc Entry',
            'FormCode' => 'Form Code',
            'Box1099' => 'Box1099',
            'PymCode' => 'Pym Code',
            'BackOrder' => 'Back Order',
            'PartDelivr' => 'Part Delivr',
            'DunnLevel' => 'Dunn Level',
            'DunnDate' => 'Dunn Date',
            'BlockDunn' => 'Block Dunn',
            'BankCountr' => 'Bank Countr',
            'CollecAuth' => 'Collec Auth',
            'DME' => 'Dme',
            'InstrucKey' => 'Instruc Key',
            'SinglePaym' => 'Single Paym',
            'ISRBillId' => 'Isr Bill ID',
            'PaymBlock' => 'Paym Block',
            'RefDetails' => 'Ref Details',
            'HouseBank' => 'House Bank',
            'OwnerIdNum' => 'Owner Id Num',
            'PyBlckDesc' => 'Py Blck Desc',
            'HousBnkCry' => 'Hous Bnk Cry',
            'HousBnkAct' => 'Hous Bnk Act',
            'HousBnkBrn' => 'Hous Bnk Brn',
            'ProjectCod' => 'Project Cod',
            'SysMatchNo' => 'Sys Match No',
            'VatIdUnCmp' => 'Vat Id Un Cmp',
            'AgentCode' => 'Agent Code',
            'TolrncDays' => 'Tolrnc Days',
            'SelfInvoic' => 'Self Invoic',
            'DeferrTax' => 'Deferr Tax',
            'LetterNum' => 'Letter Num',
            'MaxAmount' => 'Max Amount',
            'FromDate' => 'From Date',
            'ToDate' => 'To Date',
            'WTLiable' => 'Wt Liable',
            'CrtfcateNO' => 'Crtfcate No',
            'ExpireDate' => 'Expire Date',
            'NINum' => 'Ni Num',
            'AccCritria' => 'Acc Critria',
            'WTCode' => 'Wt Code',
            'Equ' => 'Equ',
            'HldCode' => 'Hld Code',
            'ConnBP' => 'Conn Bp',
            'MltMthNum' => 'Mlt Mth Num',
            'TypWTReprt' => 'Typ Wt Reprt',
            'VATRegNum' => 'Vat Reg Num',
            'RepName' => 'Rep Name',
            'Industry' => 'Industry',
            'Business' => 'Business',
            'WTTaxCat' => 'Wt Tax Cat',
            'IsDomestic' => 'Is Domestic',
            'IsResident' => 'Is Resident',
            'AutoCalBCG' => 'Auto Cal Bcg',
            'OtrCtlAcct' => 'Otr Ctl Acct',
            'AliasName' => 'Alias Name',
            'Building' => 'Building',
            'MailBuildi' => 'Mail Buildi',
            'BoEPrsnt' => 'Bo E Prsnt',
            'BoEDiscnt' => 'Bo E Discnt',
            'BoEOnClct' => 'Bo E On Clct',
            'UnpaidBoE' => 'Unpaid Bo E',
            'ITWTCode' => 'Itwt Code',
            'DunTerm' => 'Dun Term',
            'ChannlBP' => 'Channl Bp',
            'DfTcnician' => 'Df Tcnician',
            'Territory' => 'Territory',
            'BillToDef' => 'Bill To Def',
            'DpmClear' => 'Dpm Clear',
            'IntrntSite' => 'Intrnt Site',
            'LangCode' => 'Lang Code',
            'HousActKey' => 'Hous Act Key',
            'Profession' => 'Profession',
            'CDPNum' => 'Cdp Num',
            'DflBankKey' => 'Dfl Bank Key',
            'BCACode' => 'Bca Code',
            'UseShpdGd' => 'Use Shpd Gd',
            'RegNum' => 'Reg Num',
            'VerifNum' => 'Verif Num',
            'BankCtlKey' => 'Bank Ctl Key',
            'HousCtlKey' => 'Hous Ctl Key',
            'AddrType' => 'Addr Type',
            'InsurOp347' => 'Insur Op347',
            'MailAddrTy' => 'Mail Addr Ty',
            'StreetNo' => 'Street No',
            'MailStrNo' => 'Mail Str No',
            'TaxRndRule' => 'Tax Rnd Rule',
            'VendTID' => 'Vend Tid',
            'ThreshOver' => 'Thresh Over',
            'SurOver' => 'Sur Over',
            'VendorOcup' => 'Vendor Ocup',
            'OpCode347' => 'Op Code347',
            'DpmIntAct' => 'Dpm Int Act',
            'ResidenNum' => 'Residen Num',
            'UserSign2' => 'User Sign2',
            'PlngGroup' => 'Plng Group',
            'VatIDNum' => 'Vat Id Num',
            'Affiliate' => 'Affiliate',
            'MivzExpSts' => 'Mivz Exp Sts',
            'HierchDdct' => 'Hierch Ddct',
            'CertWHT' => 'Cert Wht',
            'CertBKeep' => 'Cert B Keep',
            'WHShaamGrp' => 'Wh Shaam Grp',
            'IndustryC' => 'Industry C',
            'DatevAcct' => 'Datev Acct',
            'DatevFirst' => 'Datev First',
            'GTSRegNum' => 'Gts Reg Num',
            'GTSBankAct' => 'Gts Bank Act',
            'GTSBilAddr' => 'Gts Bil Addr',
            'HsBnkSwift' => 'Hs Bnk Swift',
            'HsBnkIBAN' => 'Hs Bnk Iban',
            'DflSwift' => 'Dfl Swift',
            'AutoPost' => 'Auto Post',
            'IntrAcc' => 'Intr Acc',
            'FeeAcc' => 'Fee Acc',
            'CpnNo' => 'Cpn No',
            'NTSWebSite' => 'Nts Web Site',
            'DflIBAN' => 'Dfl Iban',
            'Series' => 'Series',
            'Number' => 'Number',
            'EDocExpFrm' => 'E Doc Exp Frm',
            'TaxIdIdent' => 'Tax Id Ident',
            'Attachment' => 'Attachment',
            'AtcEntry' => 'Atc Entry',
            'DiscRel' => 'Disc Rel',
            'NoDiscount' => 'No Discount',
            'SCAdjust' => 'Sc Adjust',
            'DflAgrmnt' => 'Dfl Agrmnt',
            'GlblLocNum' => 'Glbl Loc Num',
            'SenderID' => 'Sender ID',
            'RcpntID' => 'Rcpnt ID',
            'MainUsage' => 'Main Usage',
            'SefazCheck' => 'Sefaz Check',
            'free312' => 'Free312',
            'free313' => 'Free313',
            'DateFrom' => 'Date From',
            'DateTill' => 'Date Till',
            'RelCode' => 'Rel Code',
            'OKATO' => 'Okato',
            'OKTMO' => 'Oktmo',
            'KBKCode' => 'Kbk Code',
            'TypeOfOp' => 'Type Of Op',
            'OwnerCode' => 'Owner Code',
            'MandateID' => 'Mandate ID',
            'SignDate' => 'Sign Date',
            'Remark1' => 'Remark1',
            'ConCerti' => 'Con Certi',
            'TpCusPres' => 'Tp Cus Pres',
            'RoleTypCod' => 'Role Typ Cod',
            'BlockComm' => 'Block Comm',
            'EmplymntCt' => 'Emplymnt Ct',
            'ExcptnlEvt' => 'Excptnl Evt',
            'ExpnPrfFnd' => 'Expn Prf Fnd',
            'EdrsFromBP' => 'Edrs From Bp',
            'EdrsToBP' => 'Edrs To Bp',
            'CreateTS' => 'Create Ts',
            'UpdateTS' => 'Update Ts',
            'EDocGenTyp' => 'E Doc Gen Typ',
            'eStreet' => 'E Street',
            'eStreetNum' => 'E Street Num',
            'eBuildnNum' => 'E Buildn Num',
            'eZipCode' => 'E Zip Code',
            'eCityTown' => 'E City Town',
            'eCountry' => 'E Country',
            'eDistrict' => 'E District',
            'RepFName' => 'Rep F Name',
            'RepSName' => 'Rep S Name',
            'RepCmpName' => 'Rep Cmp Name',
            'RepFisCode' => 'Rep Fis Code',
            'RepAddID' => 'Rep Add ID',
            'PECAddr' => 'Pec Addr',
            'IPACodePA' => 'Ipa Code Pa',
            'PriceMode' => 'Price Mode',
            'EffecPrice' => 'Effec Price',
            'TxExMxVdTp' => 'Tx Ex Mx Vd Tp',
            'MerchantID' => 'Merchant ID',
            'UseBilAddr' => 'Use Bil Addr',
            'NaturalPer' => 'Natural Per',
            'DPPStatus' => 'Dpp Status',
            'EnAddID' => 'En Add ID',
            'EncryptIV' => 'Encrypt Iv',
            'EnDflAccnt' => 'En Dfl Accnt',
            'EnDflIBAN' => 'En Dfl Iban',
            'U_SOL_REGULAR' => 'U Sol Regular',
            'U_SOL_MEDICAL' => 'U Sol Medical',
            'U_SOL_KODLAM' => 'U Sol Kodlam',
            'U_SOL_ALAMAT_NPWP' => 'U Sol Alamat Npwp',
            'U_SOL_NAMA_NPWP' => 'U Sol Nama Npwp',
            'U_SOL_VIRACC' => 'U Sol Viracc',
            'U_SOL_COB_DATE' => 'U Sol Cob Date',
            'U_SOL_COB_TIME' => 'U Sol Cob Time',
            'U_SOL_COB_DAY' => 'U Sol Cob Day',
        ];
    }
}
