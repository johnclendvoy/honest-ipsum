<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HonestIpsumRequest;
use Str;

class HonestIpsumController extends Controller
{
    public $shortest_sentence_length;
    public $career = 'web developer';
    public $document = 'web page';

    public $defaults = [
        'element_count' => 2,
        'length' => 50,
        'element' => 'p',
        'career' => 'web_developer',
    ];

    function __construct()
    {
        // find the shortest sentence currently in our list
        $min = 1000;
        foreach($this->sentences as $s)
        {
            $s_length = str_word_count($s);
            if($s_length < $min)
            {
                $min = $s_length;
            }
        }
        $this->shortest_sentence_length = $min;
    }

    /*
    * show the main page with the generator, instructions, and the text
    */
    public function generate(HonestIpsumRequest $request)
    {
        $credits = $this->credits;
        $element_count = $request->input('element_count', $this->defaults['element_count']);
        $length = $request->input('length', $this->defaults['length']);
        $element = $request->input('element', $this->defaults['element']);
        $ipsum = $this->getText($element_count, $length, $element);
        return view('honest-ipsum.index', compact('ipsum', 'element', 'element_count', 'length','credits'));
    }

    /* 
    * return just the raw text
    */
    public function api(HonestIpsumRequest $request)
    {
        $length = $request->input('length', $this->defaults['length']);
        $element = $request->input('element', $this->defaults['element']);
        $element_count = $request->input('element_count', $this->defaults['element_count']);
        $career = $request->input('career', $this->defaults['career']);

        $this->career = $career;
        $this->document = $this->getDocument($career);

        // should be able to remove these and validate in the request ????
        if($element != 'p' && $element != 'li') {
            return response()->json([
                'status' => 'error',
                'message' => 'The element must be one of "p", "li", or "br".',
            ]);
        }
        if($length < $this->shortest_sentence_length || $length > 1000) {
            return response()->json([
                'status' => 'error',
                'message' => 'The length must be between ' . $this->shortest_sentence_length.' and 1000.',
            ]);
        }

        $ipsum = $this->getText($element_count, $length, $element);

        $stripped = strip_tags($ipsum);
        $total_words = str_word_count($stripped);
        $chars = strlen($stripped);
        $total_chars = strlen($ipsum);

        return response()->json([
            'words' => $total_words,
            'chars' => $chars,
            'bytes' => $total_chars,
            'result' => $ipsum,
        ]);
    }

    public function getDocument($career) {
        if (Str::contains($career, 'web')) {
            return 'web page';
        } else if (Str::contains($career, 'app')) {
            return 'application';
        } else {
            return 'document';
        }
    }

    /*
    * @param int $count = a positive integer
    * @param string $format can be 'br', 'p', or 'nl'
    * @param int $paragraph_length number of sentences
    */
    public function getText($count, $paragraph_length, $format)
    {
    	$text = '';
        if('li' == $format){ $text .= '<ul>';}
    	for($i = 0; $i < $count; $i++)
    	{
            if('p' == $format){ $text .= '<p>';}
            if('li' == $format){ $text .= '<li>';}

            $text .= $this->getParagraph($paragraph_length);

            if('p' == $format){ $text .= "</p>\n"; }
            if('li' == $format){ $text .= "</li>\n"; }
    	}
        if('li' == $format){ $text .= '</ul>';}
    	return $text;
    }

    // contunue to add sentences until there is not room for any more
    public function getParagraph($paragraph_length)
    {
        $text = '';
        $remaining = $paragraph_length;
        while($remaining >= $this->shortest_sentence_length)
        {
            $text .= $this->getSentence($remaining) . ' ';
            $remaining = $paragraph_length - str_word_count($text);
        }
        return $text;
    }

    /*
    * return a sentence, the length of the sentence must be less than the amount of words remaining
    */
    public function getSentence($words_remaining){
        $max_index = count($this->sentences)-1;
        $random = mt_rand(0,$max_index);
        $raw_sentence = $this->sentences[$random];

        $sentence =  str_replace('_CAREER_', $this->career, $raw_sentence);
        $sentence =  str_replace('_DOCUMENT_', $this->document, $sentence);

        if (str_word_count($sentence)) {
            return $sentence;
        }
        else {
            return '';
        }
    }

    protected $sentences = [
        'This text is going to be replaced once the _DOCUMENT_ is completed.',
        'The text that you are reading is only to fill the space visually.',
        'Once the _DOCUMENT_ is complete this will read something different and more relevant.',
        'It is useful for a _CAREER_ to use placeholder text so they can easily see what different fonts look like on a realistic paragraph.',
        'You are currently reading text that is written in English, not Latin.',
        'Often, something called Lorem Ipsum to fill in paragraphs before their content is finalized.',
        'There needs to be something here, even though it\'s not what you might expect on a finished _DOCUMENT_.',
        'When a _CAREER_ needs to fill in a paragraph temporarily, they will often use Latin words; Not in this paragraph though.',
        'What you are reading now is not what you will be reading in this space once this _DOCUMENT_ is completed.',
        'If you are reviewing this _DOCUMENT_, it is possible that it will be up to you to provide the content that will replace these sentences.',
        'Some common names for what you are reading are: filler text, placeholder text, and dummy text.',
        'This is just dummy text. It is essentially a placeholder so you can see what your final typefaces will look like.',
        'You are currently reading some filler text.',
        'We aren\'t quite sure what to put here yet.',
        'Don\'t waste too much of your time reading this placeholder text!',
        'This text is only here to validate the layout. It isn\'t worth reading.',
        'This is just temporary placeholder text; like when a friend saves a spot for you in line, only to be replaced by you when you return.',
        'This text isn’t going to remain here because it doesn\'t pertain to the _DOCUMENT_.',
        'Eventually, text related to your business, services or products will replace this content.',
        'If you\'re reading this on the final version of the _DOCUMENT_, most likely someone forgot to replace it. You should probably let them know.',
        'Placeholder text is useful when you need to see what a page design looks like, but the actual content isn\'t available. It\'s like having someone with identical measurements check the fit of a dress before trying it on yourself.',
        'This text is not final and should be replaced.',
        'This is placeholder text that the _CAREER_ put here to make sure words appear properly on your _DOCUMENT_.',
        'At some point someone will replace this block of text with useful words so customers can learn more about the products and services you offer!',
        'If the _CAREER_ had some useful text to place here, this is how the typeface would appear.',
        'Once the final copy for the _DOCUMENT_ has been created, it will go here.',
        'If the creator of this _DOCUMENT_ knew what to put here, they would probably not have to paste text like this here at all.',
        'This paragraph has been copied from a program that automatically generates paragraphs like this.',
        'Determining whether the typeface works or not is only possible if there is text for it to be applied to.',
        'A _CAREER_ will often use filler text so they can focus on the design of the _DOCUMENT_. It will be replaced with real content later.',
        'If you are reading these words, it probably means the _DOCUMENT_ you are viewing is still under construction.',
        'This text is only here to show you what it looks when there is text in this area of the _DOCUMENT_.',
        'This sentence will be swapped out with actual content before the _DOCUMENT_ is shown to the public.',
        'Placing some text in this area makes it easy to see what a font looks like.',
        'There isn\'t a lot of value in these words. They are just telling you why they are here.',
    ];

    /*
    * users on reddit that helped in some way
    */
    public $credits = [

        // contributed sentences
        'gotnate',
        'Brahminmeat',
        'vmcreative',
        'NotAResponsibleHuman',
        'ddollarsign',
        'TPrimeTommy',
        'melonzipper',
        'Capn_Crusty',
        'mothzilla',
        'piconet-2',
        'bugninga',
        'farnsworth',
        'erm_what_',

        'apaq11', // paragraph length
        'arturojain', // spanish
        'nexus_87', // multiple formats
        // '', // generalize designer
    ];
}
