#include "nostoepaonnistui.h"
#include "ui_nostoepaonnistui.h"

nostoepaonnistui::nostoepaonnistui(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::nostoepaonnistui)
{
    ui->setupUi(this);
}

nostoepaonnistui::~nostoepaonnistui()
{
    delete ui;
}
