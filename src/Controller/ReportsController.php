<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Document\Account;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;

class ReportsController extends AbstractController
{
    /** @Route("/reports", name="app_reports") */
    public function index(Request $request, DocumentManager $dm): Response
    {
        $id = $request->query->get('id');

        $builder = $dm->createAggregationBuilder(Account::class);
        $reports = $builder
            ->lookup('Metric')
                ->localField('_id')
                ->foreignField('accountId')
                ->alias('metric')
            ->match()
                ->field('status')
                ->equals(true)
            ->unwind('$metric')
            ->group()
                ->field('name')
                ->min('$name')
                ->field('_id')
                ->expression('$_id')
                ->field('impressions')
                ->sum('$metric.impressions')
                ->field('clicks')
                ->sum('$metric.clicks')
                ->field('spent')
                ->sum('$metric.spent')
            ->addFields()
                ->field('total')
                ->divide('$spent', '$clicks')
            ->sort('name', -1);

        if ($id) { $reports->match()->field('_id')->equals($id); }
       
        $data = $reports->getAggregation();

        return $this->render('reports/index.html.twig', [
            'controller_name' => 'ReportsController',
            'data' => $data
        ]);
    }
}
