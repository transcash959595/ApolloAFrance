$xml_post_string = "<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <AuthSoapHeader xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <strUserName>GPSDUMMY</strUserName>
      <strPassword>1nT3gr4t10N</strPassword>
    </AuthSoapHeader>
  </soap:Header>
  <soap:Body>
    <Ws_CreateCard xmlns='http://www.globalprocessing.ae/HyperionWeb'>
      <WSID>500017</WSID>
      <IssCode>PMT</IssCode>
      <TxnCode>10</TxnCode>
      <ClientCode>11</ClientCode>
      <Title>Mr</Title>
      <LastName>Pandey</LastName>
      <FirstName>Ankit</FirstName>
      <Addrl1>16611 Victory Blvd</Addrl1>
      <Addrl2>Apt 214 </Addrl2>
      <Addrl3></Addrl3>
      <City>Van Nuys</City>
      <PostCode>91406</PostCode>
      <Country>840</Country>
      <Mobile>8182031471</Mobile>
      <CardDesign>123455</CardDesign>
      <ExternalRef>1</ExternalRef>S
      <DOB>1984-09-01</DOB>
      <LocDate>2016-02-20</LocDate>
      <LocTime>120000</LocTime>
      <TerminalID>s</TerminalID>
      <LoadValue>10.0</LoadValue>
      <CurCode>840</CurCode>
      <Reason></Reason>
      <AccCode>12365877</AccCode>
      <ItemSrc>2</ItemSrc>
      <LoadFundsType>4</LoadFundsType>
      <LoadSrc>10</LoadSrc>
      <LoadFee>0.0</LoadFee>
      <LoadedBy>Admin</LoadedBy>
      <CreateImage>1</CreateImage>
      <CreateType>1</CreateType>
      <CustAccount></CustAccount>
      <ActivateNow>0</ActivateNow>
      <Source_desc></Source_desc>
      <ExpDate></ExpDate>
      <CardName>Gift Card</CardName>
      <LimitsGroup>DF-01</LimitsGroup>
      <MCCGroup></MCCGroup>
      <PERMSGroup></PERMSGroup>
      <ProductRef></ProductRef>
      <CarrierType></CarrierType>
      <Fulfil1></Fulfil1>
      <Fulfil2></Fulfil2>
      <DelvMethod>0</DelvMethod>
      <ThermalLine1></ThermalLine1>
      <ThermalLine2></ThermalLine2>
      <EmbossLine4></EmbossLine4>
      <ImageId></ImageId>
      <LogoFrontId></LogoFrontId>
      <LogoBackId></LogoBackId>
      <Replacement>0</Replacement>
      <FeeGroup></FeeGroup>
      <PrimaryToken></PrimaryToken>
      <Delv_AddrL1>16611 Victory Blvd </Delv_AddrL1>
      <Delv_AddrL2>Apt 214</Delv_AddrL2>
      <Delv_AddrL3>CA USA</Delv_AddrL3>
      <Delv_City>Van Nuys</Delv_City>
      <Delv_County>LA</Delv_County>
      <Delv_PostCode>91406</Delv_PostCode>
      <Delv_Country>840</Delv_Country>
      <Delv_Code>840</Delv_Code>
      <Lang>English</Lang>
      <Sms_Required>Yes</Sms_Required>
      <SchedFeeGroup>0</SchedFeeGroup>
      <WSFeeGroup></WSFeeGroup>
      <CardManufacturer></CardManufacturer>
      <CoBrand></CoBrand>
      <PublicToken></PublicToken>
      <ExternalAuth></ExternalAuth>
      <LinkageGroup></LinkageGroup>
      <VanityName>Ankit</VanityName>
      <PBlock></PBlock>
      <PINMailer></PINMailer>
      <FxGroup></FxGroup>
      <Email>ankitp@transcash.com</Email>
      <MailOrSMS>1</MailOrSMS>
      <AuthCalendarGroup>GROUP5</AuthCalendarGroup>
      <Quantity>10</Quantity>
      <LoadToken>7878878</LoadToken>
    </Ws_CreateCard>
  </soap:Body>
</soap:Envelope>