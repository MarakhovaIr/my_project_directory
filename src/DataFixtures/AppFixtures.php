<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $blog = new Blog();
        $blog->setName("Первый блог");
        $blog->setAnnotation("Анотация ........");
        $blog->setTopic("Создание блога");
        $blog->setDatecreation(new \DateTime());
        $manager->persist($blog);

        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setHeading('post Heading '.$i);
            $post->setDatecreation(new \DateTime());
            $post->setAnnotation('Annotation... '.$i);
            $post->setContent("Content Новый пост номер № " .$i);
            $post->setBlog($blog);
            $post->setViews(0);
            $post->setPhoto("/images/hero_1.jpg");
            $manager->persist($post);
            $comment = new Comment();
            $comment->setContent("Это коментарий " .$i);
            $comment->setPost($post);
            $comment->setDatacreated(new \DateTime());
        }

        $manager->flush();
    }
}
