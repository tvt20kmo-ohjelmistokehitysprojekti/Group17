#include "kirjauduttusisaan.h"
#include "ui_kirjauduttusisaan.h"
#include <QtNetwork>
#include <QNetworkAccessManager>
#include <QJsonDocument>
#include <qjsondocument.h>
#include "nostetturahaa.h"
#include "nostoepaonnistui.h"
kirjauduttusisaan::kirjauduttusisaan(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::kirjauduttusisaan)
{
    ui->setupUi(this);
}

kirjauduttusisaan::~kirjauduttusisaan()
{
    delete ui;
}

QString kirjauduttusisaan::getKortinIDFromMain() const
{
    return KortinIDFromMain;
}

void kirjauduttusisaan::setKortinIDFromMain(const QString &value)
{
    KortinIDFromMain = value;
}

QString kirjauduttusisaan::getTunnuslukuFromMain() const
{
    return TunnuslukuFromMain;
}

void kirjauduttusisaan::setTunnuslukuFromMain(const QString &value)
{
    TunnuslukuFromMain = value;
}

void kirjauduttusisaan::on_btn20eur_clicked()
{
    QString str = "20";
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/tilitapahtuma/nostaRahaa/?kortinID="+KortinIDFromMain+"&Saldo="+str));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="12345";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );

        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data;

        if(response_data.compare("true")==0){
            nostettuRahaa *tf=new nostettuRahaa();
            tf->show(); //avataan uusi ikkuna
            this->close();   //suljetaan nykyinen ikkuna
        }
        else{
            nostoepaonnistui *ff=new nostoepaonnistui();
            ff->show();
            this->close();
        }
        reply->deleteLater();
}

void kirjauduttusisaan::on_btn40eur_clicked()
{
    QString str = "40";
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/tilitapahtuma/nostaRahaa/?kortinID="+KortinIDFromMain+"&Saldo="+str));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="12345";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );
        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data;

        if(response_data.compare("true")==0){
            nostettuRahaa *tf=new nostettuRahaa();

            tf->show(); //avataan uusi ikkuna
            this->close();   //suljetaan nykyinen ikkuna
        }
        else{
            nostoepaonnistui *ff=new nostoepaonnistui();
            ff->show();
            this->close();
        }
        reply->deleteLater();
}

void kirjauduttusisaan::on_btn50eur_clicked()
{
    QString str = "50";
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/tilitapahtuma/nostaRahaa/?kortinID="+KortinIDFromMain+"&Saldo="+str));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="12345";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );
        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data;

        if(response_data.compare("true")==0){
            nostettuRahaa *tf=new nostettuRahaa();
            tf->show(); //avataan uusi ikkuna
            this->close();   //suljetaan nykyinen ikkuna
        }
        else{
            nostoepaonnistui *ff=new nostoepaonnistui();
            ff->show();
            this->close();
        }
        reply->deleteLater();
}

void kirjauduttusisaan::on_btn100eur_clicked()
{
    QString str = "100";
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/tilitapahtuma/nostaRahaa/?kortinID="+KortinIDFromMain+"&Saldo="+str));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="12345";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );
        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data;

        if(response_data.compare("true")==0){
            nostettuRahaa *tf=new nostettuRahaa();
            tf->show(); //avataan uusi ikkuna
            this->close();   //suljetaan nykyinen ikkuna
        }
        else{
            nostoepaonnistui *ff=new nostoepaonnistui();
            ff->show();
            this->close();
        }
        reply->deleteLater();
}

void kirjauduttusisaan::on_btnmuuSumma_clicked()
{
    QString muuSumma;
    muuSumma=ui->lineEditmuu->text();
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/tilitapahtuma/nostaRahaa/?kortinID="+KortinIDFromMain+"&Saldo="+muuSumma));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="12345";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );
        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data;

        if(response_data.compare("true")==0){
            nostettuRahaa *tf=new nostettuRahaa();
            tf->show(); //avataan uusi ikkuna
            this->close();   //suljetaan nykyinen ikkuna
        }
        else{
            nostoepaonnistui *ff=new nostoepaonnistui();
            ff->show();
            this->close();
        }
        reply->deleteLater();
}

void kirjauduttusisaan::on_pushBtnKeskeyta_clicked()
{
    this->close();
}

void kirjauduttusisaan::on_btnTapahtumakys_clicked()
{
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/tilitapahtuma/tietynTilintapahtuma?KortinID="+KortinIDFromMain));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="12345";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );
        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data; // debuggerin mukaan antaa nyt kortin id:n kautta kaikki tilitapahtumat
        QJsonDocument json_doc = QJsonDocument::fromJson(response_data);
        QJsonObject jsobj = json_doc.object();
        QJsonArray jsarr = json_doc.array();
        QString tilitapahtumat;
        foreach (const QJsonValue &value, jsarr) {
          QJsonObject jsob = value.toObject();
          tilitapahtumat+=jsob["Tapahtumatyyppi"].toString()+", "+jsob["Saldonmuutos"].toString()+"\r";
          ui->textEditTapahtuma->setText(tilitapahtumat);
        }

        reply->deleteLater();
}

void kirjauduttusisaan::on_btnSaldokys_clicked()
{
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/tili/saldo?kortinID="+KortinIDFromMain));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="12345";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );
        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data; // antaa tilillä olevan rahan määrän
        QJsonDocument json_doc = QJsonDocument::fromJson(response_data);
        ui->textEditSaldo->setText("Saldo: "+response_data);
        reply->deleteLater();
        }



