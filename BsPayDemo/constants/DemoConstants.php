<?php
namespace BsPayDemo\constants;

class DemoConstants{
    /**
     * 汇付分配的产品号
     */
    const DEMO_PRODUCT_ID = "SPIN";
    /**
     * 汇付分配的系统号
     */
    const DEMO_SYS_ID = "6666000018269234";
    /**
     * 商户进件后获得的商户号
     */
    const DEMO_HUIFU_ID = "6666000106120347";
    
    /**
     * 汇付分配的私钥，用于将报文签名
     */
    const RSA_PRIVATE_KEY = "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCiWHVf8ygNPn927zTLeqfdhww/VEIs53a59jOseAmrBwodZIKYeKuUBArEKJeTzT5ny4OG7H2COfglRYV3EO7rZa6u1IoltnSKg7xPzk/ENTPDuC5uemiJ/xIAYrjAN2ThrkjGBFwcteAraoUxs1ac7AlrnyyrKYse2HK1uq+1xowTIhXLmlIg9o07JYbOQrQyuG48u1TjwZLxjOG96DnWOYn0mXmJC8OlAoDtIUos6eJawsEP3s1XyTDiCRQaO30k6pAbMcCSaRLtpEJPB3Yk7OjNybm/TyTsDXiMDlTsZtnPfJeTmkGcLg5KkZQ27Qv9nA5gYIhT7itPj6LaVL6zAgMBAAECggEAGSuf3yWDEzKabqU9yUKWHjmfA36b1/x3IvPyJQ5jaVnpDo+T0/H5oDRUOv+UKL1MrKkYFmY6O2Ojfpvdyo0cjfCw+bhIRvqX7RXpr3HsWh5pjTHUORrPdH3Qm7CytlKgWIE+FT19zpHAVNrqFb+ZcTEDcOU39r21LS4f8t8j+Qm0WJpV8M6hreWFpvHf1IFEuTUjKm/mZG9NENp+IHxm6CNvkE0LoENf8W5SzH2kx/ZMXcC6O75tV82k4XqoWiL0e2QCDln+Njw9RD78j6icLJJiZAxUZisji/vJ0wDTnHiPcU5pk7cj+pu3qgbeT2GThKRw2DR5HOJEp2tupeot+QKBgQDz1+apnit8twVpllZ2Ev4cPDQp98iXuF8ya3YmbFJbIvfK0ab2n62b1iRIqaW50Fu4hzsM/EGz3yvKoprXUHRcufKg5sO99FlpLE2ChdLRB+4Uy1gRwCwreil/ni5YPscpv/JepoJ+l0arc45N1PDGECp6wrPOVTSDmjKt7nBYVQKBgQCqcGzqcrP63VO8dgjq1GJeGszRKr6Q0aZQS3KKXdd9yf+rVyJ7uTI2GSJj1FBfuJ0R90dOlPHmzKng6oMT08wmYVT3SHuzpwtRKNss9kyb6akRRXfRTYcnhbXFT6nA1Yb/2slcxkaBSxpfZQuUoVOzPYmf/sp/j26c24fJExLi5wKBgDb2TzOkR0ERL9Mg49Qxa72JhGiBRWGNWUfQGQ2IFPgd5aR9pRip3UPm/L60HnrHkCUDtjezFEwq3YALLsOhitjrwNirqytBzHV8Wuw0pdQf6XYeb3dwzYPvQTNWwDN70wCCF2tmNLu79V3n6gd5G9xJAIozILw9UFzpgMrbl88RAoGAR0SzhmVoNOIPfaKtn+QnLcpvEpeZD91aegDSaGFNFmA89Fx/ItUR1eU0qCHDagM8SqLnwkgtzqCN+GqXXNcXaoUQjkZU045qAQngfDCRYDCYbYxqya5tcW1L0LG6/dNLm/jUcmLGYJIS+Qi7iu7anPyCa9CSxDwpuJVjdgTvxMkCgYBzkZ1YDrtw61dJkIdI2w1L1PEx5I1iIbHFB+UbwaPYcpHcCIGa4Cc91CF8tKTNkDf/rLbdyMP/hux9PEqlZSO5TIDxVcF5IlqfvKwn5Wpb6wnzeUj3xHOnJevGxpHptSYDsK7V891GQCb4yRI1E0sy9hFOO4XtINw27GiMHBp8ag==";
    
    /**
     * 汇付分配的公钥，用于验证汇付返回报文的签名
     */
    const RSA_PUBLIC_KEY = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlfkjf2F4xsEsWFwVAjjOoqhEh6u0dMl2Z1xsTL/ytzyGRaMRXJUr47zdwpI6+3OZE+IlJwECp8T0jdFzml5vP8TWENQ4OMFt7aZ1Z/F7F9lpvMAQ+4WvucQ5ypRoLG/md0ZGnYOTb4Vnc8Pc3/fsd5UxD/nzOu5Lf4XU04FG1M0kYyjr4KelYvXPmSAVEIvik7m9kaX4oif/2RSyQhlw6gEO52TzWHrH+5w/PyTGA1xaIBAD9H7hB83nwydl1SW8u1WXiD6KTZmZ+bhi2GjeJ8KJgqBUNbN19g0DHeyHVxUAfSzOif4/ETrKw3JRjOItMpRWnfx6tcU9PmNgWx3ZhwIDAQAB";
    
    /**
     * 分账商户号
     */
    const DIV_HUIFU_ID = "6666000106120347";
    
    /**
     * 微信用户展示的付款二维码
     */
    const WX_AUTH_CODE = "135519197427874038";
	
	/**
     * 取现卡序列号
     */
    const TOKEN_NO = "10010356033";
}