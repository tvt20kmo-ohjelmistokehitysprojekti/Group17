#ifndef KIRJAUDUTTUSISAAN_H
#define KIRJAUDUTTUSISAAN_H

#include <QWidget>

namespace Ui {
class kirjauduttusisaan;
}

class kirjauduttusisaan : public QWidget
{
    Q_OBJECT

public:
    explicit kirjauduttusisaan(QWidget *parent = nullptr);
    ~kirjauduttusisaan();

    QString getKortinIDFromMain() const;
    void setKortinIDFromMain(const QString &value);

    QString getTunnuslukuFromMain() const;
    void setTunnuslukuFromMain(const QString &value);

private slots:
    void on_btn20eur_clicked();

    void on_btn40eur_clicked();

    void on_btn50eur_clicked();

    void on_btn100eur_clicked();

    void on_btnmuuSumma_clicked();

    void on_pushBtnKeskeyta_clicked();

    void on_btnTapahtumakys_clicked();

    void on_btnSaldokys_clicked();

private:
    Ui::kirjauduttusisaan *ui;
    QString KortinIDFromMain, TunnuslukuFromMain;
};

#endif // KIRJAUDUTTUSISAAN_H
