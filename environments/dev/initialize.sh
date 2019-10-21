#!/usr/bin/env bash
systemctl stop yii-queue-newproject@1
systemctl disable yii-queue-newproject@1

cp linux/services/* /etc/systemd/system
systemctl daemon-reload

systemctl start yii-queue-newproject@1
systemctl enable yii-queue-newproject@1
