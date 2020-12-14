#ifndef NOSTETTURAHAA_H
#define NOSTETTURAHAA_H

#include <QWidget>

namespace Ui {
class nostettuRahaa;
}

class nostettuRahaa : public QWidget
{
    Q_OBJECT

public:
    explicit nostettuRahaa(QWidget *parent = nullptr);
    ~nostettuRahaa();

private:
    Ui::nostettuRahaa *ui;
};

#endif // NOSTETTURAHAA_H
