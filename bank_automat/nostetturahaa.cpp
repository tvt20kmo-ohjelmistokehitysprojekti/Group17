#include "nostetturahaa.h"
#include "ui_nostetturahaa.h"

nostettuRahaa::nostettuRahaa(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::nostettuRahaa)
{
    ui->setupUi(this);
}

nostettuRahaa::~nostettuRahaa()
{
    delete ui;
}
