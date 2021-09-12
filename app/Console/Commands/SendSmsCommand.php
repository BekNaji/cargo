<?php

namespace App\Console\Commands;

use App\Models\ScheduleSms;
use Illuminate\Console\Command;
use App\Helpers\Sms\Eskiz;

class SendSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sms';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $schedule = ScheduleSms::where('status', 'scheduled')->with(['shipping', 'smsconfig', 'shipping.receiver', 'shipping.sender'])->get();

        $this->send($schedule);
    }

    public function send($schedule)
    {
        $data = $this->makeMessage($schedule);

        foreach($data as $item)
        {
            if($item['module'] == 'eskiz')
            {
                $response['sms'] = Eskiz::send($item['token'],$item);
                $response['id'] = $item['schedule_id'];
                $this->updateScheduleSms($response);
            }
        }
        
    }

    public function makeMessage($schedule)
    {
        foreach ($schedule as $sms) {
            $phone['sender'] = $sms->cargo->sender->phones[0]->code.$sms->cargo->sender->phones[0]->phone ?? false;
            $phone['receiver'] = $sms->cargo->receiver->phones[0]->code.$sms->cargo->receiver->phones[0]->phone ?? false;
            $message = $this->replaceMessage($sms);
            $data[] = [
                'schedule_id' => $sms->id,
                'smsconfig_id' => $sms->smsconfig->id,
                'module' => $sms->smsconfig->module,
                'title' => $sms->smsconfig->title,
                'login' => $sms->smsconfig->login,
                'password' => $sms->smsconfig->password,
                'token' => $sms->smsconfig->token,
                'phone' => $phone, 
                'message' => $message,
            ];
        }
        return $data;
    }


    public function replaceMessage($sms)
    {
        if ($sms->cargo->boxes) {
            $boxes = collect($sms->cargo->boxes)->implode('number', ', ');
        }
        $message = $sms->smsconfig->message;
        $message = str_replace('#SENDER#', $sms->cargo->sender->name, $message);
        $message = str_replace('#RECEIVER#', $sms->cargo->receiver->name, $message);
        $message = str_replace('#CARGO#', $sms->cargo->number, $message);
        $message = str_replace('#BOXES#', $boxes ?? '', $message);
        $message = str_replace('#STATUS#', $sms->cargo->status->name, $message);
        $message = str_replace('#STATUS_MESSAGE#', $sms->cargo->status->message, $message);
        $message = str_replace('#BR#', '' . PHP_EOL . '', $message);

        return $message;
    }

    public function updateScheduleSms($data)
    {

        $t = ScheduleSms::findOrFail($data['id'])->update([
            'status' => $data['sms']['status'],
            'message_id' => $data['sms']['id'],
            'response' => $data['sms']['message'],
        ]);

        info($t);
    }




}
