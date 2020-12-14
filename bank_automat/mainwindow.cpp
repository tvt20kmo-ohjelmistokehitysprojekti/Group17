#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QtNetwork>
#include <QNetworkAccessManager>
#include <QJsonDocument>
#include <qjsondocument.h>
#include "kirjauduttusisaan.h"

MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::MainWindow)
{
    ui->setupUi(this);
}

MainWindow::~MainWindow()
{
    delete ui;
    ui=nullptr;
}


void MainWindow::on_BtnKirjaudu_clicked()
{
    QString loginKortinID,loginTunnusluku;
    loginKortinID=ui->lineEditKortinId->text();
    loginTunnusluku=ui->lineEditSalasana->text();
    //QString qstring="http://localhost/Group17/index.php/api/Pankkikortti/check_Pankkikortti/?KortinID="+loginUsername+"&Tunnusluku="+loginPassword;
    QNetworkRequest request(QUrl("https://www.students.oamk.fi/~t9roto00/Group17/index.php/api/login/?KortinID="+loginKortinID+"&Tunnusluku="+loginTunnusluku));
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
            ui->labelLoginTest->setText("Kirjauduit sisään");
            kirjauduttusisaan *sf=new kirjauduttusisaan(); //jos salasana ja tunnus oikein avataan uusi ikkuna
            sf->setKortinIDFromMain(loginKortinID);
            sf->setTunnuslukuFromMain(loginTunnusluku);
            sf->show(); //avataan uusi ikkuna
            this->close();   //suljetaan mainwindow
        }
        else {
            ui->labelLoginTest->setText("Väärä kortin id tai salasana");
        }
        reply->deleteLater();

}
