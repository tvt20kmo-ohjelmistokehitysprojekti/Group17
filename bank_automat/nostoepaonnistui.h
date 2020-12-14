#ifndef NOSTOEPAONNISTUI_H
#define NOSTOEPAONNISTUI_H

#include <QWidget>

namespace Ui {
class nostoepaonnistui;
}

class nostoepaonnistui : public QWidget
{
    Q_OBJECT

public:
    explicit nostoepaonnistui(QWidget *parent = nullptr);
    ~nostoepaonnistui();

private:
    Ui::nostoepaonnistui *ui;
};

#endif // NOSTOEPAONNISTUI_H
