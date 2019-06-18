#!/usr/bin/env python
# -*- coding: utf-8 -*-

from pprint import pprint
import requests

from settings import sid, token


def send_message(sid, key, token, sms_from, sms_to, sms_body):
    return requests.post('https://twilix.exotel.in/v1/Accounts/{sid}/Sms/send.json'.format(sid=sid),
        auth=(key, token),
        data={
            'From': sms_from,
            'To': sms_to,
            'Body': sms_body
        })


if __name__ == '__main__':
    # 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    # For promotional, this will be ignored by the SMS gateway
    # Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
    r = send_message(sid, key, token,
        sms_from='9945235123',  # sms_from='8808891988',
        sms_to='9945235123', # sms_to='9052161119',
        sms_body='Reply 1/2 to 8088919888 to choose an appointment with Dr. Rajasekar')
    print r.status_code
    pprint(r.json())
