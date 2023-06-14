<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>

<jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
    jdbcUrl="jdbc:mysql://localhost/adventureworksdw?user=root&password=" catalogUri="/WEB-INF/queries/monaw1.xml">

    select {[Measures].[JumlahPembelian],[Measures].[HargaPembelian]} ON COLUMNS,
    {([Time],[Product],[Pembelian],[Vendor])} ON ROWS
    from [Fakta]

</jp:mondrianQuery>

<c:set var="title01" scope="session">Query AdventureWorks using Mondrian OLAP</c:set>
